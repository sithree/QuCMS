<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var siasoft\qucms\models\search\RealEstate $searchModel
 */
$this->title = 'Real Estates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="real-estate-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Real Estate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div style="overflow: scroll">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
//            'is_active',
//            'for_export',
//            'to_site',
//            'is_elite',
//            'is_deleted',
//            'date_deleted',
//            'date_sale',
//            'is_saled',
//            'is_draft',
//            'price',
//            'price_hidden',
//            'auction',
//            'rented_from',
//            'rented_to',
//            'description:ntext',
//            'description_for_site:ntext',
//            'description_near:ntext',
//            'contract_id',
//            'ID_country',
//            'ID_region',
//            'ID_city',
//            'address',
//            'is_new_building',
//            //'сompletion_date',
//            'lat',
//            'lng',
//            'year_build',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
</div>
