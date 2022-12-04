<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<div class="site-login">
    <div>
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to login:</p>

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'options' => ['class' => 'user']
                            ]); ?>
                                <?= $form->field($model, 'username',[
                                        'inputOptions' => [
                                            'class' => 'form-control form-control-user',
                                            'placeholder' => 'Enter Your Username'
                                        ]
                                ])->textInput(['autofocus' => true]) ?>

                                <?= $form->field($model, 'password', [
                                        'inputOptions' => [
                                            'class' => 'form-control form-control-user',
                                            'placeholder' => 'Enter Your Password'
                                        ]
                                ])->passwordInput() ?>

                                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?php echo \yii\helpers\Url::to(['/site/forget-password']) ?>">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
