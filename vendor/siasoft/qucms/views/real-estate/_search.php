<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\search\RealEstate $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="real-estate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'operation_id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'owner') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'floor') ?>

    <?php // echo $form->field($model, 'floors') ?>

    <?php // echo $form->field($model, 'square_all') ?>

    <?php // echo $form->field($model, 'square_living') ?>

    <?php // echo $form->field($model, 'square_kitchen') ?>

    <?php // echo $form->field($model, 'square_balcony') ?>

    <?php // echo $form->field($model, 'square_bathroom') ?>

    <?php // echo $form->field($model, 'bathroom_count') ?>

    <?php // echo $form->field($model, 'ceiling_height') ?>

    <?php // echo $form->field($model, 'room_count') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'for_export') ?>

    <?php // echo $form->field($model, 'to_site') ?>

    <?php // echo $form->field($model, 'is_elite') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'date_deleted') ?>

    <?php // echo $form->field($model, 'date_sale') ?>

    <?php // echo $form->field($model, 'is_saled') ?>

    <?php // echo $form->field($model, 'is_draft') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_hidden') ?>

    <?php // echo $form->field($model, 'auction') ?>

    <?php // echo $form->field($model, 'rented_from') ?>

    <?php // echo $form->field($model, 'rented_to') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'description_for_site') ?>

    <?php // echo $form->field($model, 'description_near') ?>

    <?php // echo $form->field($model, 'contract_id') ?>

    <?php // echo $form->field($model, 'ID_country') ?>

    <?php // echo $form->field($model, 'ID_region') ?>

    <?php // echo $form->field($model, 'ID_city') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'is_new_building') ?>

    <?php // echo $form->field($model, 'сompletion_date') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'lng') ?>

    <?php // echo $form->field($model, 'year_build') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
