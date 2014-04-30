<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model siasoft\qucms\models\User */
/* @var $roles siasoft\qucms\models\AuthItem */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'roleKeys')->checkboxList(ArrayHelper::map($roles, 'name', 'description')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' ajax']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <br>
</div>
