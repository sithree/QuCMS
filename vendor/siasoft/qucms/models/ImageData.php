<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\models;

use yii\helpers\ArrayHelper;

/**
 * Description of ImageData
 *
 * @author XPyct
 */
class ImageData extends \yii\base\Model
{
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
    public $requiredFields = [];

    public function rules()
    {
        return ArrayHelper::merge([count($this->requiredFields) > 0 ? [$this->requiredFields, 'required'] : null], [
                    [['title', 'name', 'source', 'author'], 'string', 'max' => 255],
                    ['url', 'string', 'max' => 512],
                    [['url'], 'url']
        ]);
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'source' => 'Источник',
            'url' => 'Ссылка',
            'author' => 'Автор'
        ];
    }

}
