<?php

use common\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'label' => 'image',
                'content' => function($model) {
                    /**
                     * @var Products $model
                     */
                    return Html::img($model->getImgUrl(), ['style' => 'width: 100px']);
                }
            ],
            'name',
            [
                    'attribute' => 'price',
                    'content' => function($model) {
                        /**
                         * @var Products $model
                         */
                        return '￥' . $model->price;
                    }
            ],
            [
                    'attribute' => 'status',
                    'content' => function($model) {
                        /**
                         * @var Products $model
                         */
                        return Html::tag('span', $model->status ? 'Active' : 'DisActive', [
                                'class' => $model->status ? 'badge text-bg-success' : 'badge text-bg-danger'
                        ]);
                    }
            ],
            [
                    'attribute' => 'created_at',
                    'content' => function($model) {
                        /**
                         * @var Products $model
                         */
                        return Html::tag('span', date('Y-m-d H:i', $model->created_at), [
                                'style' => 'white-space:nowrap'
                        ]);
                    }
            ],
            [
                    'attribute' => 'updated_at',
                    'content' => function($model) {
                        /**
                         * @var Products $model
                         */
                        return Html::tag('span', $model->updated_at ? date('Y-m-d H:i', $model->updated_at) : 'Null', [
                                'style' => 'white-space:nowrap'
                        ]);
                    }
            ],
            'created_by',
            'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Products $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
