<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var siasoft\qucms\models\search\ImageSection $searchModel
 */

$this->title = 'Разделы';
$this->params['breadcrumbs'][] = 'Изображения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-section-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success ajax']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'path',
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]); ?>

</div>
