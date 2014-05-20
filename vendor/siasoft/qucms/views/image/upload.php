<?php

use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $sections siasoft\qucms\models\ImageSection[] */
$this->registerAssetBundle('siasoft\qucms\web\FileUploadAsset');
$this->registerJsFile('/js/image-uploader.js', ['siasoft\qucms\web\FileUploadAsset']);
?>
<?php

$form = yii\widgets\ActiveForm::begin([
            'options' => ['id' => 'ModelForm']
        ]);
echo \yii\helpers\Html::submitButton();
yii\widgets\ActiveForm::end();
?>


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
