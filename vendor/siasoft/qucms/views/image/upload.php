<?php

use \yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use siasoft\qucms\widgets\ImageUploader;

/* @var $this yii\web\View */
/* @var $sections siasoft\qucms\models\ImageSection[] */
$this->registerAssetBundle('siasoft\qucms\web\FileUploadAsset');
$this->registerJsFile('/js/image-uploader.js', ['siasoft\qucms\web\FileUploadAsset']);

$form = ActiveForm::begin();
echo $form->field($model, 'name');
echo Html::submitButton();
ActiveForm::end();

$uploader1 = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'image',
            'targetForm' => $form, 'options' => ['class' => 'image-uploader-widget with-form']]);
$template1 = $uploader1->beginTemplate();
?>
<div class="thumbnail">
    {img}
    {label}
    <div class="buttons">
        {deleteButton}
    </div>
</div>

<div class="image-summary">
    <?php
    $template1->beginForm([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-4 col-md-3 col-lg-2',
                'wrapper' => 'col-sm-8 col-md-9 col-lg-10'
            ]
        ]
    ]);
    ?>
    <?= $template1->field('title') ?>
    <?= $template1->field('source') ?>
    <?= $template1->field('url') ?>
    <?= $template1->field('author') ?>
    <?php $template1->endForm(); ?>
</div>
<?php
$uploader1->endTemplate();
ImageUploader::end();

$uploader2 = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'images',
            'targetForm' => $form, 'options' => ['class' => 'image-uploader-widget with-form']]);
$template2 = $uploader2->beginTemplate();
?>
<div class="thumbnail">
    {img}
    {label}
    <div class="buttons">
        {deleteButton}
    </div>
</div>

<div class="image-summary">
    <?php
    $template2->beginForm([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-4 col-md-3 col-lg-2',
                'wrapper' => 'col-sm-8 col-md-9 col-lg-10'
            ]
        ]
    ]);
    ?>
    <?= $template2->field('title') ?>
    <?= $template2->field('source') ?>
    <?= $template2->field('url') ?>
    <?= $template2->field('author') ?>
    <?php $template2->endForm(); ?>
</div>
<?php
$uploader2->endTemplate();
ImageUploader::end();

$uploader3 = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'images',
            'targetForm' => $form,
            'options' => ['class' => 'image-uploader-widget'],
            'templateItemClass' => '\siasoft\qucms\widgets\Template']);
$uploader3->beginTemplate();
?>
<div class="thumbnail">
    {img}
    {label}
    <div class="buttons">
        {deleteButton}
    </div>
</div>
<?php
$uploader3->endTemplate();
ImageUploader::end();
