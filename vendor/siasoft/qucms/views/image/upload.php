<?php

use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $sections siasoft\qucms\models\ImageSection[] */
$this->registerAssetBundle('siasoft\qucms\web\FileUploadAsset');
$this->registerJsFile('/js/image-uploader.js', ['siasoft\qucms\web\FileUploadAsset']);
?>

<script>
    'use strict';
    var sections1 = <?= Json::encode($sections) ?>;
</script>
<div class="fileupload-container clearfix">
    <div>
        <span class="btn btn-success fileinput-button">
            <i class="fa fa-plus col-l"></i>
            <span>Добавить файл...</span>
            <input id="fileupload" type="file" name="files[]" data-url="<?= \yii\helpers\Url::toRoute('upload-image') ?>" accept="image/*" multiple data-sections-name="sections1">
        </span>
        <button id="sendall" class="btn btn-primary col-l">
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
<div id="messages"></div>
<div id="files" class="files"></div>
