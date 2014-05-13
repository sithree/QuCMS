<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\ImageSection $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="image-section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => 512]) ?>
    
    <?= $form->field($model, 'height')->textInput() ?>
    
    <?= $form->field($model, 'width')->textInput() ?>
    
    <?= $form->field($model, 'crop_to_max')->checkbox() ?>
    
    <?= $form->field($model, 'crop_to_width')->checkbox() ?>
    
    <?= $form->field($model, 'crop_to_height')->checkbox() ?>
    
    <?= $form->field($model, 'quality')->textInput() ?>
    
    <?= $form->field($model, 'for_retina')->checkbox() ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
