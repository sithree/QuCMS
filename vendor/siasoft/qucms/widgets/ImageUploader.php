<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

use yii\base\Widget;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * Description of Image
 *
 * @author SW-PC1
 */
class ImageUploader extends Widget
{
    /**
     * @var \siasoft\qucms\behaviors\ImageBehavior
     */
    private $_behavior;
    /**
     * @var Template
     */
    private $_templateItem;
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
     * class of template item
     * @var string 
     */
    public $templateItemClass = '\siasoft\qucms\widgets\ImageUploaderTeplate';
    public $options = [];
    /**
     * parts of template
     * @var string[]
     */
    public $templateParts = [
        '{img}' => '<img id="{id}-img" />',
        '{label}' => '<span class="label label-primary" id={id}-label></span>',
        '{deleteButton}' => '<button class="btn btn-danger btn-xs" id="{id}-delete"><i class="fa fa-minus"></i></button>',
        '{sendButton}' => '<button class="btn btn-primary btn-xs" id="{id}-upload"><i class="fa fa-upload"></i></button>'
    ];
    public $clientOptions = [
        'imageSelector' => '#{id}-img',
        'labelSelector' => '#{id}-label',
        'deleteButtonSelector' => '#{id}-delete',
        'sendButtonSelector' => '#{id}-upload'
    ];

    public function init()
    {
        parent::init();
        $this->_behavior = $behavior = $this->model->getBehavior($this->imageBehavior);
    }

    public function run()
    {
        $this->options['id'] = $this->id;
        echo $this->render('image-uploader', [
            'maxCount' => $this->_behavior->maxCount,
            'options' => $this->options
        ]);
        $this->registerScript();
    }

    public function beginTemplate(array $options = [])
    {
        $templateItemClass = $this->templateItemClass;
        $imageUploaderTemplateClass = '\siasoft\qucms\widgets\ImageUploaderTeplate';
        if ($templateItemClass === $imageUploaderTemplateClass || is_subclass_of($templateItemClass, $imageUploaderTemplateClass)) {
            $options = ArrayHelper::merge($options, [
                        'model' => \Yii::createObject([
                            'class' => $this->_behavior->dataClass,
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

    protected function registerScript()
    {
        $replaceIds = function($a) {
            return str_replace('{id}', $this->id, $a);
        };
        $options = Json::encode(array_merge([
                    'sections' => $this->_behavior->sections,
                    'template' => strtr($this->_templateItem, array_map($replaceIds, $this->templateParts)),
                    'templateOptions' => $this->_templateItem
                                ], array_map($replaceIds, $this->clientOptions)));
        $this->view->registerJs("jQuery('#{$this->id}').imageUploader($options);");
    }

}
