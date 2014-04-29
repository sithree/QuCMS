<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
        </div>
        <div class="col-xs-12">
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' ajax']) ?>
    </div>
    <table class="table table-striped table-bordered">        
        <thead>
            <tr>
                <td>Правило</td>
                <td>Описание</td>
            </tr>
        </thead>
        <?php foreach ($permissions as $item) { ?>
            <tr>
                <td>
                    <?= Html::checkbox("permission[{$item['name']}][value]", $item['on']) ?> 
                    <?= $item['name'] ?>
                    <?= Html::hiddenInput("permission[{$item['name']}][original]", $item['on']) ?>
                </td>
                <td><?= $item['description'] ?></td>
            </tr>
        <?php }
        ?>
    </table>

    <?php ActiveForm::end(); ?>
    <br>
</div>
