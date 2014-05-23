<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\RealEstate $model
 */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Real Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="real-estate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'operation_id',
            'type_id',
            'created_by',
            'owner',
            'customer_id',
            'floor',
            'floors',
            'square_all',
            'square_living',
            'square_kitchen',
            'square_balcony',
            'square_bathroom',
            'bathroom_count',
            'ceiling_height',
            'room_count',
            'created_at',
            'updated_at',
            'updated_by',
            'is_active',
            'for_export',
            'to_site',
            'is_elite',
            'is_deleted',
            'date_deleted',
            'date_sale',
            'is_saled',
            'is_draft',
            'price',
            'price_hidden',
            'auction',
            'rented_from',
            'rented_to',
            'description:ntext',
            'description_for_site:ntext',
            'description_near:ntext',
            'contract_id',
            'ID_country',
            'ID_region',
            'ID_city',
            'address',
            'is_new_building',
            'сompletion_date',
            'lat',
            'lng',
            'year_build',
        ],
    ]) ?>

</div>
