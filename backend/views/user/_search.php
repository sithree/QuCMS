<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\search\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="row">
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'username') ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'role') ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'status') ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'created_at') ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'updated_at') ?>
        </div>
    </div>

    <div class="form-group clear">
        <?= Html::submitButton('<i class="fa fa-search"></i> Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-refresh"></i> Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
