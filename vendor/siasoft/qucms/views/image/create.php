<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\ImageInfo $model
 */

$this->title = 'Create Image Info';
$this->params['breadcrumbs'][] = ['label' => 'Image Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
