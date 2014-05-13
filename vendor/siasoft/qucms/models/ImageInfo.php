<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "image_info".
 *
 * @property integer $id
 * @property integer $section
 * @property integer $original
 * @property string $title
 * @property string $name
 * @property integer $width
 * @property integer $height
 * @property integer $size
 */
class ImageInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['width', 'height', 'size', 'original'], 'default', 'value' => 0],
            [['section', 'original', 'width', 'height', 'size'], 'integer'],
            [['original', 'title', 'name', 'width', 'height', 'size'], 'required'],
            [['title', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section' => 'Section',
            'original' => 'Original',
            'title' => 'Title',
            'name' => 'Name',
            'width' => 'Width',
            'height' => 'Height',
            'size' => 'Size',
        ];
    }

}
