<?php

use \yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use siasoft\qucms\widgets\Template;
use siasoft\qucms\widgets\ScriptTemplate;
use siasoft\qucms\widgets\ImageUploader;
use siasoft\qucms\widgets\LazyActiveForm;

/* @var $this yii\web\View */
/* @var $sections siasoft\qucms\models\ImageSection[] */
$this->registerAssetBundle('siasoft\qucms\web\FileUploadAsset');
$this->registerJsFile('/js/image-uploader.js', ['siasoft\qucms\web\FileUploadAsset']);

$form = ActiveForm::begin();
echo Html::submitButton();
ActiveForm::end();

$uploader1 = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'image',
            'targetForm' => $form]);
$template1 = $uploader1->beginTemplate();
?>
<div class="image-item clearfix">
    <div class="thumbnail">
        <span class="label label-primary image-label"></span>
        <div class="buttons">
            <button class="btn btn-danger btn-xs delete">
                <i class="fa fa-minus"></i>
            </button>
            <button class="btn btn-primary btn-xs send">
                <i class="fa fa-upload"></i>
            </button>
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
        <div class="image-sections"></div>
        <?php $template1->endForm(); ?>
    </div>
</div>
<?php
$uploader1->endTemplate();
ImageUploader::end();

$uploader2 = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'images',
            'targetForm' => $form]);
$template2 = $uploader2->beginTemplate(['formClass' => '\yii\widgets\ActiveForm']);
?>
<div class="image-item clearfix">
    <div class="thumbnail">
        <span class="label label-primary image-label"></span>
        <div class="buttons">
            <button class="btn btn-danger btn-xs delete">
                <i class="fa fa-minus"></i>
            </button>
            <button class="btn btn-primary btn-xs send">
                <i class="fa fa-upload"></i>
            </button>
        </div>
    </div>
    <div class="image-summary">
        <?php
        $template2->beginForm();
        ?>
        <?= $template2->field('title'); ?>
        <?= $template2->field('source') ?>
        <?= $template2->field('url') ?>
        <?= $template2->field('author') ?>
        <div class="image-sections"></div>
        <?php $template2->endForm() ?>
    </div>
</div>
<?php
$uploader2->endTemplate();
ImageUploader::end();

$uploader3 = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'images',
            'targetForm' => $form, 'templateItemClass' => '\siasoft\qucms\widgets\ScriptTemplate']);
$uploader3->beginTemplate();
?>
<div class="image-item clearfix">
    <div class="thumbnail">
        <span class="label label-primary image-label"></span>
        <div class="buttons">
            <button class="btn btn-danger btn-xs delete">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
</div>
<?php
$uploader3->endTemplate();
ImageUploader::end();
