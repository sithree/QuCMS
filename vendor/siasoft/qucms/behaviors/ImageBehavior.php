<?php

namespace siasoft\qucms\behaviors;

/**
 * Description of Image
 * @property string $name Name of behavior
 * @property string $modelName Name of owner
 * @author SW-PC1
 */
class ImageBehavior extends \yii\base\Behavior implements \JsonSerializable {

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
    
    /**
     * list of required fields
     * @var string[]
     */
    public $requiredFields = [];
    
    /**
     * Count of required images
     * @var int
     */
    public $requiredCount = 0;

    /**
     * Getter for modelName
     * @return string
     */
    protected function getModelName() {
        $class = $this->owner->className();
        return mb_substr($class, mb_strrpos($class, '\\') + 1);
    }
    
    /**
     * Getter for name
     * @return string
     */
    protected function getName() {
        if ($this->_name === null) {
            return $this->_name = array_search($this, $this->owner->behaviors, true);
        }
        return $this->_name;
    }
    
    public function canGetProperty($name, $checkVars = true) {
        switch ($name) {
            case 'name':
            case 'maxCount':
            case 'modelName':
            case 'requiredFields':
                return false;
        }
        return parent::canGetProperty($name, $checkVars);
    }

    public function jsonSerialize() {
        return [
            'object' => $this->modelName,
            'property' => $this->name,
            'max' => $this->maxCount,
            'sections' => $this->sections,
            'requiredFields' => $this->requiredFields,
            'requiredCount' => $this->requiredCount
        ];
    }

}
