<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

use yii\base\Widget;
use yii\helpers\Json;
use yii\web\View;

/**
 * Description of Image
 *
 * @author SW-PC1
 */
class ImageUploader extends Widget {

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
     * item template
     * @var \yii\widgets\ActiveForm
     */
    public $templateItem;

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

    public function init() {
        parent::init();
        $behavior = $this->model->getBehavior($this->imageBehavior);
        $this->imageData = new \siasoft\qucms\models\ImageData(['requiredFields' => $behavior->requiredFields]);
    }

    public function run() {
        echo $this->render('image-uploader', [
            'imageBehavior' => $this->model->getBehavior($this->imageBehavior)
        ]);
    }
}
