<?php
namespace frontend\controllers;

use common\models\CartItems;
use common\models\Products;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CartController extends Controller {

     public function actionIndex()
     {
        return $this->render('index');
     }

     public function actionCreate()
     {
         //获取商品id
         $id = yii::$app->request->post('id');
         $products = Products::findOne(['id' => $id]);
         if(!isset($products))
         {
             return new NotFoundHttpException();
         }

         $cartItem_model = new CartItems();
         $cartItem_model->product_id = $id;
         $cartItem_model->quantity = isset($cartItem_model->quantity) ? $cartItem_model->quantity + 1 : 1;
         $cartItem_model->created_by = yii::$app->user->id;

//         if ($cartItem_model->save())
//         {
//            return $this->response
//         }
     }
 }