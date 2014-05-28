<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "contractor_address".
 *
 * @property integer $id
 * @property integer $contractor_id
 * @property integer $contract_type_id
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $city_id
 * @property string $post_index
 * @property string $address
 * @property double $lat
 * @property double $lng
 *
 * @property Contractor $contractor
 */
class ContractorAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractor_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contractor_id', 'contract_type_id', 'country_id', 'state_id', 'city_id'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['post_index'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 2555]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contractor_id' => 'Contractor ID',
            'contract_type_id' => 'Contract Type ID',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'city_id' => 'City ID',
            'post_index' => 'Post Index',
            'address' => 'Address',
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['id' => 'contractor_id']);
    }
}
