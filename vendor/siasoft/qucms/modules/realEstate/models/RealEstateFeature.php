<?php

namespace siasoft\qucms\modules\realEstate\models;

use Yii;

/**
 * This is the model class for table "real_estate_feature".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $type
 *
 * @property RealEstateObjectFeature $realEstateObjectFeature
 * @property RealEstate[] $realEstates
 */
class RealEstateFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'real_estate_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['type'], 'string'],
            [['name'], 'string', 'max' => 255]
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
            'parent_id' => 'Parent ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstateObjectFeature()
    {
        return $this->hasOne(RealEstateObjectFeature::className(), ['real_estate_feature_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstates()
    {
        return $this->hasMany(RealEstate::className(), ['id' => 'real_estate_id'])->viaTable('real_estate_object_feature', ['real_estate_feature_id' => 'id']);
    }
}
