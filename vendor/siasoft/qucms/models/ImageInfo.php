<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "image_info".
 *
 * @property integer $id
 * @property integer $section_id
 * @property string $title
 * @property integer $width
 * @property integer $height
 * @property integer $size
 *
 * @property ImageSection $section
 * @property ImageSource $imageSource
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
            [['section_id', 'width', 'height', 'size'], 'integer'],
            [['title', 'width', 'height', 'size'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_id' => 'Section ID',
            'title' => 'Заголовок',
            'width' => 'Ширина',
            'height' => 'Высота',
            'size' => 'Размер',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(ImageSection::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageSource()
    {
        return $this->hasOne(ImageSource::className(), ['image_id' => 'id']);
    }
}
