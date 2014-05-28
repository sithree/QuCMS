<?php

namespace siasoft\qucms\modules\realEstate\models;

use Yii;

/**
 * This is the model class for table "real_estate_target".
 *
 * @property integer $id
 * @property string $title
 *
 * @property RealEstate[] $realEstates
 */
class RealEstateTarget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'real_estate_target';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        return $this->hasMany(RealEstate::className(), ['target_id' => 'id']);
    }
}
