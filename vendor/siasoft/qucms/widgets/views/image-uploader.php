<?php
/* @var $maxCount int */
/* @var $this yii\web\View */

use \yii\helpers\Url;
?>
<?= yii\helpers\Html::beginTag('div', $options) ?>
<div class = "image-uploader-container clearfix">
    <div>
        <span class = "btn btn-success fileinput-button">
            <i class = "fa <?= $maxCount === 1 ? 'fa-folder-open' : 'fa-plus' ?>"></i>
            <span><?= $maxCount === 1 ? 'Открыть...' : 'Добавить файл...' ?></span>
            <input class="image-uploader" type="file" name="files[]" data-url="<?= Url::toRoute('/qucms/image/upload-image'); ?>" accept="image/*" <?= $maxCount !== 1 ? 'multiple' : ''; ?> >
        </span>
        <button class="btn btn-primary sendall">
            <i class="fa fa-upload"></i>
            <span>Отправить</span>
        </button>
    </div>
    <div>
        <div id="progress" class="progress" >
            <div class="progress-bar"></div>
        </div>
    </div>
</div>
<div class="messages"></div>
<ul class="files" class="files"></ul>
<div class="clear"></div>
<?= yii\helpers\Html::endTag('div') ?>
