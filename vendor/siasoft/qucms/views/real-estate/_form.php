<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\RealEstate $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="real-estate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operation_id')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'floors')->textInput() ?>

    <?= $form->field($model, 'square_all')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'owner')->textInput() ?>

    <?= $form->field($model, 'bathroom_count')->textInput() ?>

    <?= $form->field($model, 'room_count')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'for_export')->textInput() ?>

    <?= $form->field($model, 'to_site')->textInput() ?>

    <?= $form->field($model, 'is_elite')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?>

    <?= $form->field($model, 'is_saled')->textInput() ?>

    <?= $form->field($model, 'is_draft')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_hidden')->textInput() ?>

    <?= $form->field($model, 'auction')->textInput() ?>

    <?= $form->field($model, 'contract_id')->textInput() ?>

    <?= $form->field($model, 'ID_country')->textInput() ?>

    <?= $form->field($model, 'ID_region')->textInput() ?>

    <?= $form->field($model, 'ID_city')->textInput() ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?= $form->field($model, 'is_new_building')->textInput() ?>

    <?= $form->field($model, 'year_build')->textInput() ?>

    <?= $form->field($model, 'square_living')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'square_kitchen')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'square_balcony')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'square_bathroom')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'ceiling_height')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'date_deleted')->textInput() ?>

    <?= $form->field($model, 'date_sale')->textInput() ?>

    <?= $form->field($model, 'rented_from')->textInput() ?>

    <?= $form->field($model, 'rented_to')->textInput() ?>

    <?= $form->field($model, 'сompletion_date')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_for_site')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_near')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'lng')->textInput(['maxlength' => 25]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
