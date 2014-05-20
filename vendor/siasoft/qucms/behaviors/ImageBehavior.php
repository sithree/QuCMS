<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\behaviors;

/**
 * Description of Image
 * @property string $name Name of behavior
 * @property string $modelName Name of owner
 * @author SW-PC1
 */
class ImageBehavior extends \yii\base\Behavior
{
    private $_name;
    /**
     * Max count of images, 0 - ulimited
     * @var int
     */
    public $maxCount = 1;
    /**
     * list of image sections for generate image
     * @var string[]
     */
    public $sections = [];
    
    public function getModelName() {
        $class = $this->owner->className();
        return mb_substr($class, mb_strrpos($class, '\\') + 1);
    }

    public function getName()
    {
        if ($this->_name === null) {
            return $this->_name = array_search($this, $this->owner->behaviors, true);
        }
        return $this->_name;
    }

}
