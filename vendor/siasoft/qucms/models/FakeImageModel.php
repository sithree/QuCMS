<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\models;

/**
 * Description of FakeImageModel
 *
 * @author SW-PC1
 */
class FakeImageModel extends \yii\db\ActiveRecord
{
    public $imageId;

    public function behaviors()
    {
        return [
            'images' => [
                'class' => 'siasoft\qucms\behaviors\ImageBehavior',
                'maxCount' => 0,
                'sections' => ['preview'],
            ],
            'image' => [
                'class' => 'siasoft\qucms\behaviors\ImageBehavior',
                'sections' => ['preview', 'thumbnail', 'title']
            ]
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        
    }
    
    public function attributes()
    {
        return [];
    }

}
