<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

/**
 * Description of ImageUploaderTeplate
 *
 * @author SW-PC1
 */
class ImageUploaderTeplate extends ScriptTemplate
{
    /**
     *
     * @var \yii\widgets\ActiveForm
     */
    private $_form;
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
        return $class::end();
    }

    public function field($fieldName, array $options = [])
    {
        return $this->_form->field($this->model, $fieldName, $options);
    }

}
