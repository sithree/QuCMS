<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

/**
 * Description of ScriptTemplate
 * @property string $name Name teplate variable
 * @author XPyct
 */
class ScriptTemplate extends Template {

    protected function getName() {
        return "template{$this->id}";
    }

    //put your code here
    public function run() {
        parent::run();
        $template = \yii\helpers\Json::encode($this->template);
        $this->view->registerJs("var {$this->name} = $template");
    }

}
