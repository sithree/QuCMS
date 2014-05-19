<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "image_source".
 *
 * @property integer $image_id
 * @property string $name
 * @property string $link
 * @property string $author
 */
class ImageSource extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id'], 'required'],
            [['image_id'], 'integer'],
            [['name', 'source_name', 'author'], 'string', 'max' => 255],
            [['link'], 'url', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'name' => 'Имя',
            'source' => 'Имя источника',
            'url' => 'Url',
            'author' => 'Автор',
        ];
    }

}
