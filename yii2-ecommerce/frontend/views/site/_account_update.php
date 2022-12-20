<?php
/** @var common\models\User $userModel */
/** @var yii\bootstrap5\ActiveForm $UserForm */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

?>

<div>


<!--    更新成功-->
    <?php if (isset($success) && $success == true):?>
        <div class="alert alert-success" role="alert">
            your information have been updated
        </div>
    <?php endif?>

    <?php $UserForm = ActiveForm::begin([
        'action' => ['/user/update'],
        'options' => [
            'data-pjax' => 1
        ]
    ]); ?>

        <?= $UserForm->field($userModel, 'username')->textInput(['maxlength' => true]) ?>

        <?= $UserForm->field($userModel, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>