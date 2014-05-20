<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

/**
 * Description of Image
 *
 * @author SW-PC1
 */
class Image extends \yii\base\Widget
{
    public $model;
    public $imageBehavior;
    public $formSelector;

    public function run()
    {
        echo $this->render('Image', [
            'imageBehavior' => $this->model->getBehavior($this->imageBehavior),
            'formSelector' => $this->formSelector
        ]);
    }

}
