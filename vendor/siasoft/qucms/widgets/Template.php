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
class Template extends \yii\base\Widget
{
    public $template;

    public static function begin($config = array())
    {
        ob_start();
        return parent::begin($config);
    }

    public static function end()
    {
        $template = ob_get_contents();
        ob_end_clean();
        $widget = parent::end();
        $widget->template = $template;
        return $widget;
    }

}
