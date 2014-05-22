<?php
/* @var $imageBehavior \siasoft\qucms\behaviors\ImageBehavior */
/* @var $formSelector string */
/* @var $this yii\web\View */
?>
<div id="<?= $this->context->id; ?>" class="image-uploader-widget"> 
    <div class="image-uploader-container clearfix">
        <div>
            <span class="btn btn-success fileinput-button">
                <i class="fa <?= $imageBehavior->maxCount === 1 ? 'fa-folder-open' : 'fa-plus' ?>"></i>
                <span><?= $imageBehavior->maxCount === 1 ? 'Открыть...' : 'Добавить файл...' ?></span>
                <input class="image-uploader" type="file" name="file" data-url="<?= \yii\helpers\Url::toRoute('/qucms/image/upload-image'); ?>" accept="image/*" <?= $imageBehavior->maxCount !== 1 ? 'multiple' : ''; ?>>
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
    <div class="files" class="files"></div>
</div>