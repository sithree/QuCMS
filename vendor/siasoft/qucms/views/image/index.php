<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var siasoft\qucms\models\search\ImageInfo $searchModel
 */
$this->title = 'Image Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    siasoft\qucms\widgets\Filter::widget([
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ])
    ?>

    <p>
        <?= Html::a('Create Image Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'section',
            'title',
            'source.name',
            'source.source',
            'source.url',
            'source.author',
            'width',
            'height',
            'size',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
