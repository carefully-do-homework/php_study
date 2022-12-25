<?php
/** @var common\models\User $userModel*/
/** @var yii\bootstrap5\ActiveForm $UserForm*/
/** @var common\models\UserAddresses $addressModel*/
/** @var yii\bootstrap5\ActiveForm $AddressForm*/

use yii\bootstrap5\ActiveForm;
?>

<div style="display: flex">
    <div style="flex: 1">
        <div class="card  m-3">
            <div class="card-header">
                User Information
            </div>
            <div class="card-body">

                <?php $UserForm = ActiveForm::begin() ?>
                    <?= $UserForm->field($userModel, 'username') ?>
                    <?= $UserForm->field($userModel, 'email') ?>
                <?php $UserForm = ActiveForm::end() ?>

            </div>
        </div>
        <div class="card  m-3">
            <div class="card-header">
                Address Information
            </div>
            <div class="card-body">

                <?php $AddressForm = ActiveForm::begin() ?>
                    <?= $AddressForm->field($addressModel, 'address') ?>
                    <?= $AddressForm->field($addressModel, 'city') ?>
                    <?= $AddressForm->field($addressModel, 'state') ?>
                    <?= $AddressForm->field($addressModel, 'country') ?>
                    <?= $AddressForm->field($addressModel, 'zipcode') ?>
                <?php $AddressForm = ActiveForm::end() ?>

            </div>
        </div>
    </div>
    <div class="card  m-3" style="flex: 1; height: 200px">
        <div class="card-header">
            Order Summary
        </div>
        <div class="card-body" style="position: relative">
            <div style="border-bottom: 1px solid #eee; overflow: hidden; padding-bottom: 5px">
                <span style="float: left">Total Price</span>
                <span style="float: right">￥123.00</span>
            </div>
            <a class="btn btn-primary" style="position: absolute;bottom: 10px;right: 10px">continue</a>
        </div>
    </div>
</div>
