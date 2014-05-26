<?php
/* @var $imageBehavior \siasoft\qucms\behaviors\ImageBehavior */
/* @var $formSelector string */
/* @var $this yii\web\View */

use yii\helpers\Json;
use siasoft\qucms\widgets\Template;
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

<?php Template::begin(); ?>
<script>
    $('#<?= $this->context->id; ?>').imageUploader({
        template: template<?= $this->context->_templateItem->id; ?>,
        beforeAdd: function(template) {
            //rename<?php //$this->context->templateForm->id ?>Ids(template, 10);
        },
        afterAdd: function(form) {
            //init<?php //$this->context->templateForm->id ?>Form(form, 10);
        },
        imageContainerSelector: '<?= $this->context->imageContainerSelector ?>',
        labelSelector: '<?= $this->context->labelSelector ?>',
        submitSelector: '<?= $this->context->submitSelector ?>',
        deleteSelector: '<?= $this->context->deleteSelector ?>',
        sections: '<?= Json::encode($imageBehavior->sections) ?>'
    });
</script>
<?php
$this->registerJs(str_replace(['<script>', '</script>'], '', Template::end()));
