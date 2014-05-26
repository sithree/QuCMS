<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveFormAsset;

/**
 * Description of LazyForm
 *
 * @author XPyct
 */
class LazyActiveForm extends \yii\bootstrap\ActiveForm {

    public function run() {
        if (!empty($this->attributes)) {
            $id = $this->options['id'];
            $options = Json::encode($this->getClientOptions());
            $attributes = $this->getJsonAttributes();
            $rename = $this->getRenameIds();
            $view = $this->getView();
            ActiveFormAsset::register($view);
            $view->registerJs("function rename{$id}Ids(template, id){{$rename}};function init{$id}Form(form, id){form.yiiActiveForm($attributes, $options);};");
        }
        echo Html::endForm();
    }

    protected function getRenameIds() {
        $result = "";
        foreach ($this->attributes as $value) {
            $result.="template.find('#{$value['id']}').attr('id', '{$value['id']}' + id);";
            $newId = mb_substr($value['input'], 1);
            if ($value['id'] !== $newId) {
                $result.="template.find('{$value['input']}').attr('id', '$newId' + id);";
            }
        }
        return $result;
    }

    protected function getJsonAttributes() {
        $attributes = $this->attributes;
        $search = [];
        $replace = [];
        foreach ($attributes as $value) {
            $replace[] = ($search[] = '"' . $value['id'] . '"') . '+id';
            $replace[] = ($search[] = '"' . $value['input'] . '"') . '+id';
        }
        return str_replace($search, $replace, Json::encode($attributes));
    }

}
