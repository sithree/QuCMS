<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

use yii\helpers\Json;
use \yii\web\View;

/**
 * Description of Image
 *
 * @author SW-PC1
 */
class ImageUploader extends Template {

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
    
    /**
     * jQuey selector for imageContainer
     * @var string
     */
    public $imageContainerSelector = '.image-thumb';
    
    /**
     * jQuey selector for label
     * @var string 
     */
    public $labelSelector = '.image-label';
    
    public $submitSelector = '.send';
    
    public $deleteSelector = '.delete';

    public function run() {
        echo $this->render('image-uploader', [
            'imageBehavior' => $this->model->getBehavior($this->imageBehavior)
        ]);
    }

    public static function begin($config = array()) {
        $widget = parent::begin($config);
        $behavior = $widget->model->getBehavior($widget->imageBehavior);
        $widget->imageData = new \siasoft\qucms\models\ImageData(['requiredFields' => $behavior->requiredFields]);
        return $widget;
    }

    public static function end() {
        $widget = parent::end();
        $template = Json::encode(str_replace("id=\"{$widget->templateForm->id}\"", '', $widget->template));
        $widgetScript = array_pop($widget->view->js[View::POS_READY]);
        $formScript = str_replace("jQuery('#{$widget->templateForm->id}')", 'sender', array_pop($widget->view->js[View::POS_READY]));
        $script = "var {$widget->id}template = $template;init{$widget->id}Form = function(sender) { $formScript };$widgetScript";
        $widget->view->registerJs($script);
        return $widget;
    }

}
