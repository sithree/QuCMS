<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property string $fio
 * @property string $type
 * @property string $birth_day
 * @property integer $sex
 * @property string $work_phone
 * @property string $mobile_phone
 * @property string $home_phone
 * @property string $skype
 * @property string $email
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $city_id
 * @property string $post_index
 * @property string $address
 * @property string $lat
 * @property string $lng
 * @property integer $use_email
 * @property integer $use_phone
 * @property integer $use_post
 * @property integer $use_sms
 *
 * @property ContractorContact $contractorContact
 * @property Contractor[] $contractors
 * @property RealEstate[] $realEstates
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio'], 'required'],
            [['type'], 'string'],
            [['birth_day'], 'safe'],
            [['sex', 'country_id', 'state_id', 'city_id', 'use_email', 'use_phone', 'use_post', 'use_sms'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            [['work_phone', 'mobile_phone', 'home_phone'], 'string', 'max' => 11],
            [['skype', 'email'], 'string', 'max' => 100],
            [['post_index'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 2555],
            [['lat', 'lng'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'type' => 'Type',
            'birth_day' => 'Birth Day',
            'sex' => 'Sex',
            'work_phone' => 'Work Phone',
            'mobile_phone' => 'Mobile Phone',
            'home_phone' => 'Home Phone',
            'skype' => 'Skype',
            'email' => 'Email',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'city_id' => 'City ID',
            'post_index' => 'Post Index',
            'address' => 'Address',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'use_email' => 'Use Email',
            'use_phone' => 'Use Phone',
            'use_post' => 'Use Post',
            'use_sms' => 'Use Sms',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractorContact()
    {
        return $this->hasOne(ContractorContact::className(), ['contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractors()
    {
        return $this->hasMany(Contractor::className(), ['id' => 'contractor_id'])->viaTable('contractor_contact', ['contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstates()
    {
        return $this->hasMany(RealEstate::className(), ['contact_id' => 'id']);
    }
}
