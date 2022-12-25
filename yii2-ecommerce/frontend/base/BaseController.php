<?php
namespace frontend\base;

use Yii;
use yii\web\Controller;
use common\models\CartItems;

    class BaseController extends Controller
    {
        public function beforeAction($action)
        {
            $cart_count = count(CartItems::findAll(['created_by' => yii::$app->user->id]));
            $this->view->params['cartItemCount'] = empty($cart_count) ? '' : $cart_count;
            return parent::beforeAction($action);
        }
    }
