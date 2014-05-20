<?php
/* @var $imageBehavior \siasoft\qucms\behaviors\ImageBehavior */
/* @var $formSelector string */
?>
<div class="fileupload-widget" data-formselector="<?= $formSelector ?>" data-model="<?= $imageBehavior->modelName ?>" data-behavior="<?= $imageBehavior->name ?>"> 
    <div class="fileupload-container clearfix">
        <div>
            <span class="btn btn-success fileinput-button">
                <i class="fa <?= $imageBehavior->maxCount === 1 ? 'fa-folder-open' : 'fa-plus' ?>"></i>
                <span><?= $imageBehavior->maxCount === 1 ? 'Открыть...' : 'Добавить файл...' ?></span>
                <input class="fileupload" type="file" name="file" data-url="<?= \yii\helpers\Url::toRoute('/qucms/image/upload-image') ?>" accept="image/*" <?= $imageBehavior->maxCount !== 1 ? 'multiple' : '' ?> >
                </input>
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