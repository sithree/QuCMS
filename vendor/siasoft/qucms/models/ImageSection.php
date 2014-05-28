<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "image_section".
 *
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $url
 * @property integer $width
 * @property integer $height
 * @property integer $crop_to_max
 * @property integer $crop_to_width
 * @property integer $crop_to_height
 * @property integer $quality
 * @property integer $for_retina
 *
 * @property ImageInfo $imageInfo
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
            [['name', 'path', 'url', 'crop_to_height'], 'required'],
            [['width', 'height', 'crop_to_max', 'crop_to_width', 'crop_to_height', 'quality', 'for_retina'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['path', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'path' => 'Path',
            'url' => 'Url',
            'width' => 'Width',
            'height' => 'Height',
            'crop_to_max' => 'Crop To Max',
            'crop_to_width' => 'Crop To Width',
            'crop_to_height' => 'Crop To Height',
            'quality' => 'Quality',
            'for_retina' => 'For Retina',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageInfo()
    {
        return $this->hasOne(ImageInfo::className(), ['section_id' => 'id']);
    }
}
