<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \siasoft\qucms\models\search\AuthItem */
/* @var $model \siasoft\qucms\models\AuthItem */

$this->title = 'Роли';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permissions-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Создать', ['create'], ['class' => 'btn btn-success ajax']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{pager}\n{summary}\n{items}\n{pager}",
        'pager' => [
            'firstPageLabel' => '&laquo;&laquo;',
            'lastPageLabel' => '&raquo;&raquo;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description',
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]);
    ?>
</div>