<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "contractor".
 *
 * @property integer $id
 * @property string $name
 * @property string $alter_name
 * @property integer $parent_contractor_id
 * @property integer $owner_id
 * @property integer $is_vip
 * @property integer $ownership_id
 * @property string $phone
 * @property string $phone_add
 * @property string $fax
 * @property string $skype
 * @property string $email
 * @property string $site
 *
 * @property ContractorAddress[] $contractorAddresses
 * @property ContractorContact $contractorContact
 * @property Contact[] $contacts
 * @property RealEstate[] $realEstates
 */
class Contractor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'owner_id'], 'required'],
            [['parent_contractor_id', 'owner_id', 'is_vip', 'ownership_id'], 'integer'],
            [['name', 'alter_name'], 'string', 'max' => 45],
            [['phone', 'phone_add', 'fax'], 'string', 'max' => 11],
            [['skype', 'email'], 'string', 'max' => 100],
            [['site'], 'string', 'max' => 255]
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
            'alter_name' => 'Alter Name',
            'parent_contractor_id' => 'Parent Contractor ID',
            'owner_id' => 'Owner ID',
            'is_vip' => 'Is Vip',
            'ownership_id' => 'Ownership ID',
            'phone' => 'Phone',
            'phone_add' => 'Phone Add',
            'fax' => 'Fax',
            'skype' => 'Skype',
            'email' => 'Email',
            'site' => 'Site',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractorAddresses()
    {
        return $this->hasMany(ContractorAddress::className(), ['contractor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractorContact()
    {
        return $this->hasOne(ContractorContact::className(), ['contractor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['id' => 'contact_id'])->viaTable('contractor_contact', ['contractor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstates()
    {
        return $this->hasMany(RealEstate::className(), ['contractor_id' => 'id']);
    }
}
