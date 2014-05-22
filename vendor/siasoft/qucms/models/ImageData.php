<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\models;

/**
 * Description of ImageData
 *
 * @author XPyct
 */
class ImageData extends \yii\base\Model {

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $source;

    /**
     *
     * @var string
     */
    public $url;

    /**
     *
     * @var string
     */
    public $author;

    /**
     *
     * @var string[]
     */
    public $files;
    
    /**
     *
     * @var string[]
     */
    public $requiredFields;

    public function rules() {
        return [
            [$this->requiredFields, 'required'],
            [['title', 'name', 'source', 'author'], 'string', 'max' => 255],
            [['url'], 'url']
        ];
    }

}
