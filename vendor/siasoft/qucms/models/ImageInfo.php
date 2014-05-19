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
            [['width', 'height', 'size'], 'default', 'value' => 0],
            [['section', 'width', 'height', 'size'], 'integer'],
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
            'section' => 'Раздел',
            'title' => 'Заголовок',
            'width' => 'Ширина',
            'height' => 'Высота',
            'size' => 'Размер'
        ];
    }

    public function getSource()
    {
        return $this->hasOne(ImageSource::className(), ['image_id' => 'id']);
    }

}
