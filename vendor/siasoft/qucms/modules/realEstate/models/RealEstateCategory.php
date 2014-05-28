<?php

namespace siasoft\qucms\modules\realEstate\models;

use Yii;

/**
 * This is the model class for table "real_estate_category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $sub_type_id
 *
 * @property RealEstate[] $realEstates
 * @property RealEstateSubCategory $subType
 */
class RealEstateCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'real_estate_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'sub_type_id'], 'required'],
            [['sub_type_id'], 'integer'],
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
            'title' => 'Title',
            'sub_type_id' => 'Sub Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstates()
    {
        return $this->hasMany(RealEstate::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubType()
    {
        return $this->hasOne(RealEstateSubCategory::className(), ['id' => 'sub_type_id']);
    }
}
