<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\ImageInfo $model
 */

$this->title = 'Update Image Info: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Image Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
