<?php
namespace frontend\controllers;

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
                    'delete' => [ 'post']
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
        var_dump($totalPrice);

//        return $this->render('checkout', [
//            'userModel' => $userModel,
//            'addressModel' => $addressModel,
//            'totalPrice' => $totalPrice
//        ]);
    }
 }