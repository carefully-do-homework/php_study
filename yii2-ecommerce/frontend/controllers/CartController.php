<?php
namespace frontend\controllers;

use common\models\OrderAddresses;
use common\models\OrderItems;
use common\models\Orders;
use frontend\service\Alipay;
use common\models\CartItems;
use common\models\Products;
use common\models\User;
use common\models\UserAddresses;
use Yii;
use yii\base\BaseObject;
use yii\base\ViewNotFoundException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use function Psy\debug;

class CartController extends \frontend\base\BaseController {

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter:: class,
                'actions' => [
                    'index'  => [ 'get'],            //只允许get方式访问
                    'create' => [ 'post'],          //只允许用post方式访问
                    'update' => [ 'post'],
                    'delete' => [ 'post'],
                    'test' => ['post']
                ],
            ],
        ];
    }


    public function actionIndex()
     {
        $user = new User();
        $user->id = yii::$app->user->id;

        //当前用户购物车的商品信息
        $allCartItem = $user->connect;

         //当前用户购物车的各个商品数量
        $CartItem_quantity = [];
        $current_user_cart = CartItems::findAll(['created_by' => $user]);
        foreach ($current_user_cart as $cartItem) {
            $CartItem_quantity[$cartItem->product_id] = $cartItem->quantity;
        }


        return $this->render('index', [
            'allCartItem' => $allCartItem,
            'CartItem_quantity' => $CartItem_quantity
        ]);
     }

    /**
     * 购物车增加商品
     */
     public function actionCreate()
     {
         //获取商品id
         $id = yii::$app->request->post('id');

         $allCartItem = CartItems::findAll(['created_by' => yii::$app->user->id]);
         foreach($allCartItem as $cartItem) {
             if ($cartItem->product_id == $id) {
                 $cartItem_model = $cartItem;
             }
         }

         if(isset($cartItem_model)) {
             $cartItem_model->quantity++;
             $cartItemCount = count($allCartItem);
         }else {
             $products = Products::findOne(['id' => $id]);

             if(!isset($products))
             {
                 return new NotFoundHttpException();
             }

             $cartItem_model = new CartItems();
             $cartItem_model->product_id = $id;
             $cartItem_model->quantity = isset($cartItem_model->quantity) ? $cartItem_model->quantity + 1 : 1;
             $cartItem_model->created_by = yii::$app->user->id;

             $cartItemCount = count($allCartItem) + 1;
         }

         Yii::$app->response->format = Response::FORMAT_JSON;
         if ($cartItem_model->save())
         {
            return [
                'success' => true,
                'cartItemCount' => $cartItemCount
            ];
         }else {
             return [
                 'success' => false,
                 'cartItemCount' => $cartItemCount
             ];
         }
     }

    /**
     * 购物车删除商品
     */
     public function actionDelete($id) {
        if(!isset($id)) {
            return new ViewNotFoundException('id must be taking');
        }

        CartItems::deleteAll(['product_id' => $id, 'created_by' => yii::$app->user->id]);

        return $this->redirect('index');
     }

    /**
     * 购物车更新商品信息
     */
    public function actionUpdate() {
        $id = trim(yii::$app->request->post('id'));
        if(!isset($id)) {
            return new ViewNotFoundException('id must be taking');
        }

        $model = CartItems::findOne(['product_id' => $id]);
        if(!isset($model)) {
            return new ViewNotFoundException('this cartItem not found');
        }

        $quantity_count = trim(yii::$app->request->post('quantity_count'));
        $model->quantity = $quantity_count;

        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!$model->save())
        {
            return [
                'success' => false
            ];
        }

        $product_price = Products::findOne(['id' => $model->product_id])->price;

        return [
            'success' => true,
            'quantity_count' => $model->quantity,
            'total_price' => $model->quantity * $product_price
        ];
    }

    /**
     * 购物车选好商品后，点击checkout
     */
    public function actionCheckout() {
        $userModel = yii::$app->user->identity;
        $addressModel = UserAddresses::findOne(['user_id' => yii::$app->user->identity->id]);

        //没有地址信息，先要完善地址信息
        if(!isset($addressModel)) {
            $this->view->params['isShowRefineAddressNotice'] = true;

            $userAddress = $userModel->address;
            return $this->render('/profile/profile', [
                'userModel' => $userModel,
                'userAddress' => $userAddress
            ]);
        }

        $totalPrice = CartItems::getTotalPrice();

        return $this->render('checkout', [
            'userModel' => $userModel,
            'addressModel' => $addressModel,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * 点击continue按钮，进行支付宝支付
     */
    public function actionContinue() {
        $alipay = new Alipay();
        $totalPrice = (float)CartItems::getTotalPrice();

        $transaction = yii::$app->db->beginTransaction();

        //插入Orders表
        $order = new Orders();
        $order->total_price = $totalPrice;
        $order->username = yii::$app->user->identity->getName();
        $order->status = 0;
        $order->email = yii::$app->user->identity->getEmail();
        $order->transaction_id = hexdec(uniqid()) . '';
        if(!$order->save()) {
            $transaction->rollBack();
            return json_encode($order->errors);
        }


        $addressModel = UserAddresses::findOne(['user_id' => yii::$app->user->identity->id]);

        //插入OrderAddresses表
        $order_address = new OrderAddresses();
        $order_address->order_id = $order->id;
        $order_address->address = $addressModel->address;
        $order_address->city = $addressModel->city;
        $order_address->state = $addressModel->state;
        $order_address->country = $addressModel->country;
        $order_address->zipcode = $addressModel->zipcode;
        if(!$order_address->save()) {
            $transaction->rollBack();
            return json_encode($order_address->errors);
        }

        //插入OrderItems表
        $batch = [];
        $allCartItem = CartItems::findAll(['created_by' => yii::$app->user->id]);
        foreach ($allCartItem as $cartItem) {
            $product = Products::findOne(['id' => $cartItem->product_id]);
            if(!$product) {
                return json_encode(['message' => 'notfound product']);
            }
            $batch[] = [$product->name, $cartItem->product_id, $product->price, $order->id, $cartItem->quantity];
        }
        $sql = yii::$app->db->queryBuilder->batchInsert(OrderItems::tableName(), ['product_name','product_id','unit_price','order_id','quantity'], $batch);
        $res = yii::$app->db->createCommand($sql)->execute();

        $transaction->commit();

        $message = [
            'userId' =>yii::$app->user->id,
            'transaction_id' => $order->transaction_id
        ];
        Yii::$app->redis->set($order->transaction_id, json_encode($message));
        yii::$app->redis->expire($order->transaction_id, 5400);

        $alipay->pay('商品结账', $order->transaction_id, $totalPrice, yii::$app->params['openHost'] . '/site/index');
    }


    /**
     * 支付完成
     */
    public function actionFinishPay() {
        $out_trade_no = yii::$app->request->post('out_trade_no');
        $trade_status = yii::$app->request->post('trade_status');

        if ($trade_status == 'TRADE_SUCCESS')
        {
            if (!isset($out_trade_no))
            {
                return new NotFoundHttpException('have not out_trade_no');
            }

            $trade_message = yii::$app->redis->get($out_trade_no);

            if (!isset($trade_message))
            {
                return new NotFoundHttpException('have not this key from redis');
            }

            $trade_message = json_decode($trade_message);
            $userId = $trade_message->userId;
            $transaction_id = $trade_message->transaction_id;

            $orderModel = Orders::findOne(['transaction_id' => $transaction_id]);
            $orderModel->status = 1;
            if(!$orderModel->save())
            {
                return json_encode($orderModel->errors);
            }

            CartItems::deleteAll(['created_by' => $userId]);

            Yii::$app->redis->del($transaction_id);

            //对用户发送邮箱
            $email = yii::$app->mailer->compose();
            $email->setTo('646989546@qq.com');
            $email->setSubject('测试发送邮箱');
            $email->setHtmlBody('<div>感谢你对我商店的支持，祝你生活愉快</div>');
            if($email->send())
                echo "success";
            else
                echo "failse";
            die();
        }
    }

 }