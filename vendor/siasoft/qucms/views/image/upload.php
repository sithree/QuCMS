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
$m = new \siasoft\qucms\models\ImageData();
echo Html::submitButton();
ActiveForm::end();

$uploader = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'image',
            'form' => $form]);
$uploader->templateItem = $template = ScriptTemplate::begin();
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
        $uploader->templateForm = $templateForm = $template->start(LazyActiveForm::className(), [
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4 col-md-3 col-lg-2',
                            'wrapper' => 'col-sm-8 col-md-9 col-lg-10'
                        ]
                    ]
        ]);
        ?>
        <?= $templateForm->field($uploader->imageData, 'title') ?>
        <?= $templateForm->field($uploader->imageData, 'source') ?>
        <?= $templateForm->field($uploader->imageData, 'url') ?>
        <?= $templateForm->field($uploader->imageData, 'author') ?>
        <div class="image-sections"></div>
        <?php $template->finish(LazyActiveForm::className()) ?>
    </div>
</div>
<?php
ScriptTemplate::end();
ImageUploader::end();

$uploader = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'images',
            'form' => $form]);
$uploader->templateItem = $template = ScriptTemplate::begin();
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
        $uploader->templateForm = $templateForm = $template->start(LazyActiveForm::className(), [
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4 col-md-3 col-lg-2',
                            'wrapper' => 'col-sm-8 col-md-9 col-lg-10'
                        ]
                    ]
        ]);
        ?>
        <?= $templateForm->field($uploader->imageData, 'title'); ?>
        <?= $templateForm->field($uploader->imageData, 'source') ?>
        <?= $templateForm->field($uploader->imageData, 'url') ?>
        <?= $templateForm->field($uploader->imageData, 'author') ?>
        <div class="image-sections"></div>
        <?php $template->finish(LazyActiveForm::className()) ?>
    </div>
</div>
<?php
ScriptTemplate::end();
ImageUploader::end();

$uploader = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'images',
            'form' => $form]);
$uploader->templateItem = ScriptTemplate::begin();
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
ScriptTemplate::end();
ImageUploader::end();
