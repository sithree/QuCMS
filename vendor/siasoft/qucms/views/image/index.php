<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel siasoft\qucms\models\search\ImageInfo */

$this->title = 'Image Infos';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/filter.js', ['yii\web\JqueryAsset', 'siasoft\qucms\web\FileUploadAsset']);
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
            'id',
            'section',
            'title',
            'imageSource.name',
            'imageSource.source',
            'imageSource.url',
            'imageSource.author',
            'width',
            'height',
            'size',
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]);
    ?>

</div>
