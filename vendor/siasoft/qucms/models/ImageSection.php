<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "image_section".
 *
 * @property integer $id
 * @property string $name
 * @property string $path
 */
class ImageSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['width', 'height'], 'default', 'value' => 0],
            ['quality', 'default', 'value' => 75],
            [['name', 'path', 'url'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['path'], 'string', 'max' => 512],
            [['width', 'height', 'crop_to_max', 'crop_to_width', 'crop_to_height', 'quality', 'for_retina'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'Имя',
            'path' => 'Путь',
            'width' => 'Ширина',
            'height' => 'Высота',
            'crop_to_max' => 'Обрезать по максимальному',
            'crop_to_width' => 'Обрезать по высоте',
            'crop_to_height' => 'Обрезать по ширене',
            'quality' => 'Качество',
            'for_retina' => 'Для retina-дисплеев'
        ];
    }
}
