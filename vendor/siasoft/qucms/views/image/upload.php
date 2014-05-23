<?php

use \yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use siasoft\qucms\widgets\Template;
use siasoft\qucms\widgets\ImageUploader;

/* @var $this yii\web\View */
/* @var $sections siasoft\qucms\models\ImageSection[] */
$this->registerAssetBundle('siasoft\qucms\web\FileUploadAsset');
$this->registerJsFile('/js/image-uploader.js', ['siasoft\qucms\web\FileUploadAsset']);
//$reflector = new ReflectionFunction(function() {
//    $a = 5;
//    echo "hello" . $a;
//});
//$file = file($reflector->getFileName());
//$file = array_slice($file, $reflector->getStartLine() - 1, $reflector->getEndLine() - $reflector->getStartLine() + 1);
//$tokens = token_get_all('<?php ' . implode($file, '') . ' ?/>');
//foreach ($tokens as $value) {
//    if (is_string($value)) {
//        echo $value.'<br/>';
//        continue;
//    }
//    echo token_name(array_shift($value)) . ' ' . array_shift($value) . '<br/>';
//}

$form = ActiveForm::begin();
echo Html::submitButton();
ActiveForm::end();


//Шаблон поля формы
Template::begin();
?>
<div class="col-xs-1">
    {label}
</div>
<div class="col-xs-11">
    {input}
</div>
<div class="col-xs-1">{hint}</div>
<div class="col-xs-11">
    {error}
</div>
<?php
$inputTemplate = Template::end();

$uploader = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'image',
            'form' => $form]);
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
        $uploader->templateForm = $templateForm = ActiveForm::begin([
                    'fieldConfig' => [
                        'template' => $inputTemplate->template
                    ],
                    'class' => 'form-horizontal'
        ]);
        $inputOptions = ['class' => 'form-control input-sm'];
        ?>
        <div class="row">
            <?= $templateForm->field($uploader->imageData, 'title')->textInput($inputOptions); ?>
            <?= $templateForm->field($uploader->imageData, 'source')->textInput($inputOptions); ?>
            <?= $templateForm->field($uploader->imageData, 'url')->textInput($inputOptions); ?>
            <?= $templateForm->field($uploader->imageData, 'author')->textInput($inputOptions); ?>
        </div>
        <div class="image-sections"></div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php ImageUploader::end(); ?>

<?php
$uploader = ImageUploader::begin(['model' => $model, 'imageBehavior' => 'images',
            'form' => $form]);
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
        $uploader->templateForm = $templateForm = ActiveForm::begin([
                    'fieldConfig' => [
                        'template' => $inputTemplate->template
                    ],
                    'class' => 'form-horizontal'
        ]);
        $inputOptions = ['class' => 'form-control input-sm'];
        ?>
        <div class="row">
            <?= $templateForm->field($uploader->imageData, 'title')->textInput($inputOptions); ?>
            <?= $templateForm->field($uploader->imageData, 'source')->textInput($inputOptions); ?>
            <?= $templateForm->field($uploader->imageData, 'url')->textInput($inputOptions); ?>
            <?= $templateForm->field($uploader->imageData, 'author')->textInput($inputOptions); ?>
        </div>
        <div class="image-sections"></div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php ImageUploader::end(); ?>