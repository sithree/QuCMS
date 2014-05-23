<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var siasoft\qucms\models\RealEstate $model
 */

$this->title = 'Create Real Estate';
$this->params['breadcrumbs'][] = ['label' => 'Real Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="real-estate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
