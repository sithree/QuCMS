<?php

namespace siasoft\qucms\modules\realEstate\models;

use Yii;

/**
 * This is the model class for table "real_estate_object_feature".
 *
 * @property integer $real_estate_id
 * @property integer $real_estate_feature_id
 * @property string $text_value
 * @property integer $int_value
 *
 * @property RealEstate $realEstate
 * @property RealEstateFeature $realEstateFeature
 */
class RealEstateObjectFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'real_estate_object_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['real_estate_id', 'real_estate_feature_id'], 'required'],
            [['real_estate_id', 'real_estate_feature_id', 'int_value'], 'integer'],
            [['text_value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'real_estate_id' => 'Real Estate ID',
            'real_estate_feature_id' => 'Real Estate Feature ID',
            'text_value' => 'Text Value',
            'int_value' => 'Int Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstate()
    {
        return $this->hasOne(RealEstate::className(), ['id' => 'real_estate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstateFeature()
    {
        return $this->hasOne(RealEstateFeature::className(), ['id' => 'real_estate_feature_id']);
    }
}
