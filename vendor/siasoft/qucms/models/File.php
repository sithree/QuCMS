<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\models;

use Yii;
use yii\base\Model;

/**
 * Description of File
 *
 * @author SW-PC1
 */
class File extends Model
{
    public $title;
    public $source;
    public $url;
    public $author;

    public function rules()
    {
        return [
            ['title', 'required'],
            [['source', 'url', 'author'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'заголовок',
            'source' => 'источник',
            'url' => 'ссылка',
            'author' => 'автор'
        ];
    }

}
