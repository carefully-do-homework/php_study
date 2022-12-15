<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:html',
            [
                    'attribute' => 'image',
                    'format' => 'html',
                    'value' => function($model) {
                        /**
                         * @var \common\models\Products $model
                         */
                        return Html::img($model->getImgUrl());
                    }

            ],
            [
                    'attribute' => 'price',
                    'value' => function($model) {
                        /**
                         * @var \common\models\Products $model
                         */
                        return '￥' . $model->price;
                    }
            ],
            [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function($model) {
                        /**
                         * @var \common\models\Products $model
                         */
                        return Html::tag('span', $model->status ? 'Active' : 'DisActive', [
                            'class' => $model->status ? 'badge text-bg-success' : 'badge text-bg-danger'
                        ]);
                    }
            ],
            [
                    'attribute' => 'created_at',
                    'format' => 'html',
                    'value' => function($model) {
                        /**
                         * @var \common\models\Products $model
                         */
                        return Html::tag('span', date('Y-m-d H:i', $model->created_at), [
                            'style' => 'white-space:nowrap'
                        ]);
                    }
            ],
            [
                    'attribute' => 'updated_at',
                    'format' => 'html',
                    'value' => function($model) {
                        /**
                         * @var \common\models\Products $model
                         */
                        return Html::tag('span', $model->updated_at ? date('Y-m-d H:i', $model->updated_at) : 'Null', [
                            'style' => 'white-space:nowrap'
                        ]);
                    }
            ],
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>

</div>
