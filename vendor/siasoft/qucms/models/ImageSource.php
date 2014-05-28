<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "image_source".
 *
 * @property integer $image_id
 * @property string $name
 * @property string $source
 * @property string $url
 * @property string $author
 *
 * @property ImageInfo $image
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
            [['name', 'source', 'url', 'author'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'name' => 'Name',
            'source' => 'Source',
            'url' => 'Url',
            'author' => 'Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ImageInfo::className(), ['id' => 'image_id']);
    }
}
