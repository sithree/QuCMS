<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\RealEstate $model
 */

$this->title = 'Update Real Estate: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Real Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="real-estate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
