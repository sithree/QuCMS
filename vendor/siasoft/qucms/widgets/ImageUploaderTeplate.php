<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

use yii\helpers\Json;

/**
 * Description of ImageUploaderTeplate
 *
 * @author SW-PC1
 */
class ImageUploaderTeplate extends Template implements \JsonSerializable
{
    /**
     *
     * @var \yii\widgets\ActiveForm
     */
    private $_form;
    private $_formScript;
    private $_renameScript;
    public $formClass = '\yii\bootstrap\ActiveForm';
    public $model;

    public function init()
    {
        $activeForm = '\yii\widgets\ActiveForm';
        if ($this->formClass != $activeForm && !is_subclass_of($this->formClass, $activeForm)) {
            throw new \yii\base\InvalidConfigException("{$this->formClass} not extend $activeForm");
        }
        parent::init();
    }

    public function beginForm(array $options = [])
    {
        $class = $this->formClass;
        return $this->_form = $class::begin($options);
    }

    public function endForm()
    {
        $class = $this->formClass;
        $rename = '';
        foreach ($this->_form->attributes as &$value) {
            $id = $value['id'];
            $input = $value['input'];
            $rename .= "form.find('#$id').attr('id', '$id-{$this->id}-' + id);";
            $value['id'] = new \yii\web\JsExpression("'$id-{$this->id}-' + id");
            $value['input'] = new \yii\web\JsExpression("'$input-{$this->id}-' + id");
        }
        unset($value);

        $result = $class::end();

        $this->_renameScript = $rename;
        $this->_formScript = str_replace("'#{$this->_form->id}'", 'form', array_pop($this->view->js[\yii\web\View::POS_READY]));
        return $result;
    }

    public function field($fieldName, array $options = [])
    {
        return $this->_form->field($this->model, $fieldName, $options);
    }

    public function jsonSerialize()
    {
        $form = $this->_form;
        if (!$form) {
            return [];
        }
        return [
            'renameIds' => new \yii\web\JsExpression("function(form, id){{$this->_renameScript}}"),
            'initForm' => new \yii\web\JsExpression("function(form, id){{$this->_formScript}}")
        ];
    }

}
