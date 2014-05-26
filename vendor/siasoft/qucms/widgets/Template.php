<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

/**
 * Description of Template
 *
 * @author SW-PC1
 */
class Template extends \yii\base\Widget {

    protected $template;

    public function init() {
        ob_start();
    }

    public function run() {
        $this->template = ob_get_clean();
    }
    
    public function __toString() {
        return $this->template;
    }
    
    public function start($className) {
        return $className::begin();
    }
    
    public function finish($className) {
        return $className::end();
    }
}
