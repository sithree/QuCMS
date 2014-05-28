<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "contractor_contact".
 *
 * @property integer $contractor_id
 * @property integer $contact_id
 *
 * @property Contact $contact
 * @property Contractor $contractor
 */
class ContractorContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contractor_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contractor_id', 'contact_id'], 'integer'],
            [['contact_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contractor_id' => 'Contractor ID',
            'contact_id' => 'Contact ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['id' => 'contractor_id']);
    }
}
