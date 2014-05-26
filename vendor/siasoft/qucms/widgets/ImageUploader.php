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
use yii\helpers\ArrayHelper;

/**
 * Description of Image
 *
 * @author SW-PC1
 */
class ImageUploader extends Widget
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
    public $targetForm;
    /**
     * jQuey selector for imageContainer
     * @var string
     */
    public $imageContainerSelector = '.image-thumb';
    /**
     * jQuey selector for label
     * @var string 
     */
    public $templateItemClass = '\siasoft\qucms\widgets\ImageUploaderTeplate';
    public $labelSelector = '.image-label';
    public $submitSelector = '.send';
    public $deleteSelector = '.delete';
    public $_templateItem;
    /**
     *
     * @var \siasoft\qucms\behaviors\ImageBehavior
     */
    private $_behavior;

    public function init()
    {
        parent::init();
        $this->_behavior = $behavior = $this->model->getBehavior($this->imageBehavior);
    }

    public function run()
    {
        echo $this->render('image-uploader', [
            'imageBehavior' => $this->model->getBehavior($this->imageBehavior)
        ]);
    }

    public function beginTemplate(array $options = [])
    {
        $templateItemClass = $this->templateItemClass;
        $imageUploaderTemplateClass = '\siasoft\qucms\widgets\ImageUploaderTeplate';
        if ($templateItemClass === $imageUploaderTemplateClass || is_subclass_of($templateItemClass, $imageUploaderTemplateClass)) {
            $options = ArrayHelper::merge($options, [
                        'model' => \Yii::createObject($this->_behavior->dataClass, [
                            'requiredFields' => $this->_behavior->requiredFields
            ])]);
        }
        return $this->_templateItem = $templateItemClass::begin($options);
    }

    public function endTemplate()
    {
        $templateItemClass = $this->templateItemClass;
        $templateItemClass::end();
    }

}
