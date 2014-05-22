<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

/**
 * Description of Image
 *
 * @author SW-PC1
 */
class ImageUploader extends Template
{
    /**
     * target model
     * @var \yii\base\Model
     */
    public $model;
    /**
     * name of image behavior
     * @var string
     */
    public $imageBehavior;
    /**
     * editing form of model
     * @var \yii\widgets\ActiveForm
     */
    public $form;
    /**
     * form from this item template
     * @var \yii\widgets\ActiveForm
     */
    public $templateForm;
    /**
     * model contain info about image
     * @var \yii\base\Model
     */
    public $imageData;

    public function run()
    {
        echo $this->render('image-uploader', [
            'imageBehavior' => $this->model->getBehavior($this->imageBehavior)
        ]);
    }

    public static function begin($config = array())
    {
        $widget = parent::begin($config);
        $behavior = $widget->model->getBehavior($widget->imageBehavior);
        $widget->imageData = new \siasoft\qucms\models\ImageData(['requiredFields' => $behavior->requiredFields]);
        return $widget;
    }

    public static function end()
    {
        $widget = parent::end();
        echo $widget->template;
        $widget->view->registerJs('var ' . $widget->form->id . 'template = ' . \yii\helpers\Json::encode(str_replace([
                                ], [], $widget->template)) . '; initForm = function() { ' . each(array_pop($widget->view->js))['value'] . '}; initForm(); $("#'.$widget->id.'").imageUploader();');
        return $widget;
    }

}
