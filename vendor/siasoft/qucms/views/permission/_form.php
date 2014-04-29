<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
        </div>
        <div class="col-xs-12">
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' ajax']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<br>
</div>
