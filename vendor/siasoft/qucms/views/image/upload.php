<?php

use yii\helpers\Json;

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
?>
<?php
$form = yii\widgets\ActiveForm::begin([
            'options' => ['id' => 'ModelForm']
        ]);
echo \yii\helpers\Html::submitButton();
yii\widgets\ActiveForm::end();
?>

<div class="uploadcontainer clearfix">
    <div class="img-thumbnail">
        <span class="label label-primary">{title}</span>
        <div class="buttons">
            <button class="btn btn-danger btn-xs delete">
                <i class="fa fa-minus"></i>
            </button>
            <button class="btn btn-primary btn-xs delete">
                <i class="fa fa-upload"></i>
            </button>
        </div>
    </div>
    <div class="summary">
        <?php $form = yii\bootstrap\ActiveForm::begin(); ?>
        <?= $form->field($data, 'title', ['template' => '{input}'])->textInput(['class' => 'form-control input-sm']); ?>
        <?= $form->field($data, 'source', ['template' => '{input}'])->textInput(['class' => 'form-control input-sm']); ?>
        <?= $form->field($data, 'url', ['template' => '{input}'])->textInput(['class' => 'form-control input-sm']); ?>
        <?= $form->field($data, 'author', ['template' => '{input}'])->textInput(['class' => 'form-control input-sm']); ?>
        <div class="sections"></div>
        <div class="messages"></div>
        <?php yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>

<?=
siasoft\qucms\widgets\Image::widget([
    'model' => $model,
    'imageBehavior' => 'image',
    'formSelector' => '#ModelForm'
])
?>

<?=
siasoft\qucms\widgets\Image::widget([
    'model' => $model,
    'imageBehavior' => 'images',
    'formSelector' => '#ModelForm'
])
?>
