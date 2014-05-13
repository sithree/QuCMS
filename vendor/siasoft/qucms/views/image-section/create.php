<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\ImageSection $model
 */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = 'Изображения';
$this->params['breadcrumbs'][] = ['label' => 'Разделы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-section-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
