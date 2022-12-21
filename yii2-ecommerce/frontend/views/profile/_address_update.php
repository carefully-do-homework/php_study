<?php
/** @var common\models\UserAddresses $userAddress */
/** @var yii\bootstrap5\ActiveForm $AddressForm */
/** @var bool $success */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

?>

<div>



        <?php if (isset($success) && $success == true):?>
            <div class="alert alert-success" role="alert">
                your information have been updated
            </div>
        <?php endif?>

        <?php $AddressForm = ActiveForm::begin([
            'action' => ['/user-addresses/update'],
            'options' => [
                'data-pjax' => 1
            ]
        ]); ?>

            <?= $AddressForm->field($userAddress, 'address')->textInput(['maxlength' => true]) ?>

            <?= $AddressForm->field($userAddress, 'city')->textInput(['maxlength' => true]) ?>

            <?= $AddressForm->field($userAddress, 'state')->textInput(['maxlength' => true]) ?>

            <?= $AddressForm->field($userAddress, 'country')->textInput(['maxlength' => true]) ?>

            <?= $AddressForm->field($userAddress, 'zipcode')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>
</div>
