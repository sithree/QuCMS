<?php

namespace siasoft\qucms\modules\realEstate\models;

use Yii;

/**
 * This is the model class for table "real_estate_sub_category".
 *
 * @property integer $id
 * @property string $title
 *
 * @property RealEstate[] $realEstates
 * @property RealEstateCategory[] $realEstateCategories
 */
class RealEstateSubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'real_estate_sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstates()
    {
        return $this->hasMany(RealEstate::className(), ['sub_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstateCategories()
    {
        return $this->hasMany(RealEstateCategory::className(), ['sub_type_id' => 'id']);
    }
}
