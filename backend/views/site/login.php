<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->registerCssFile('/third/icheck/skins/minimal/grey.css');
$this->registerCssFile('/css/animate.css');
$this->registerJsFile('/third/icheck/icheck.min.js', ['yii\web\JqueryAsset']);
$this->registerJs("$('.checkbox input').iCheck({
	checkboxClass: 'icheckbox_minimal-grey',
	radioClass: 'iradio_minimal-grey',
	increaseArea: '20%' // optional
	});");

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- Begin Login Page -->
<div class="full-content-center animated fadeInDownBig">
    <img src="/img/main/logo-login.png" class="logo-login img-circle" alt="Logo">
    <div class="login-wrap">
        <div class="box-info">
            <h2 class="text-center"><strong>Авторизация</strong></h2>

            <?php
            $form = ActiveForm::begin(['id' => 'login-form',
                        'fieldConfig' => [
                            'template' => '<div class="form-group login-input">'
                            . '{icon}{input}{error}'
                            . '</div>'
            ]]);
            ?>
            <?= $form->field($model, 'username', ['parts' => ['{icon}' => '<i class="fa fa-sign-in overlay"></i>']])->textInput(['placeholder' => 'Логин', 'class' => 'form-control text-input']) ?>
            <?= $form->field($model, 'password', ['parts' => ['{icon}' => '<i class="fa fa-key overlay"></i>']])->passwordInput(['placeholder' => 'Пароль', 'class' => 'form-control text-input']) ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="loginForm[rememberMe]"> запомнить меня
                </label>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= Html::submitButton('<i class="fa fa-unlock"></i>Вход', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <p class="text-center">
        <a href="forgot-password.html">
            <i class="fa fa-lock"></i>
            Forgot password?
        </a>
    </p>
</div>
<!-- End Login Page -->