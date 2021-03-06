<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\ImageInfo $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Image Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'section',
            'title',
            'name',
            'width',
            'height',
            'size',
        ],
    ]) ?>

</div>
