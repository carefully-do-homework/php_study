<?php
/** @var common\models\User $userModel */
/** @var common\models\UserAddresses $userAddress */
/** @var yii\bootstrap5\ActiveForm $AddressForm */
/** @var yii\bootstrap5\ActiveForm $UserForm */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

?>

<div style="display: flex">
    <div class="card  m-3" style="flex: 1">
        <div class="card-header">
            Address information
        </div>
        <div class="card-body">
            <div>

                <?php $AddressForm = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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
        </div>
    </div>
    <div class="card  m-3" style="flex: 1">
        <div class="card-header">
            Account information
        </div>
        <div class="card-body">
            <div>

                <?php $UserForm = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $UserForm->field($userModel, 'username')->textInput(['maxlength' => true]) ?>

                <?= $UserForm->field($userModel, 'email')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>



