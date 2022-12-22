<?php
namespace frontend\controllers;

use common\models\CartItems;
use common\models\Products;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends \frontend\base\BaseController {



    public function actionIndex()
     {
        $allCartItem = CartItems::findAll(['created_by' => yii::$app->user->id]);
        return $this->render('index', [
            'allCartItem' => $allCartItem
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
 }