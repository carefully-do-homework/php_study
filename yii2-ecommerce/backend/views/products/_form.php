<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Products $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(weditor\Weditor::class,
        ['width'=>1000, 'height'=>200]); ?>

    <?= $form->field($model, 'imageFile')->textInput([
            'type' => 'file'
    ]) ?>

    <?= $form->field($model, 'price')->textInput([
            'maxlength' => true,
            'type' => 'number'
    ]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
