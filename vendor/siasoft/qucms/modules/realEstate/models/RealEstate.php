<?php

namespace siasoft\qucms\modules\realEstate\models;

use Yii;
use siasoft\qucms\models\User;
use siasoft\qucms\models\Country;
use siasoft\qucms\models\Region;
use siasoft\qucms\models\City;
use siasoft\qucms\models\Contractor;
use siasoft\qucms\models\Contact;

/**
 * This is the model class for table "real_estate".
 *
 * @property integer $id
 * @property integer $target_id
 * @property integer $category_id
 * @property integer $sub_category_id
 * @property integer $created_by
 * @property integer $owner_id
 * @property integer $contractor_id
 * @property integer $contact_id
 * @property integer $room_count
 * @property integer $floor
 * @property integer $floors
 * @property double $square_all
 * @property double $square_living
 * @property double $square_kitchen
 * @property double $square_balcony
 * @property double $square_bathroom
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $status
 * @property string $date_sale
 * @property integer $price
 * @property integer $price_hidden
 * @property integer $auction
 * @property integer $is_rented
 * @property integer $is_deleted
 * @property integer $to_site
 * @property integer $for_export
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property string $address
 * @property double $lat
 * @property double $lng
 * @property integer $build_material_id
 * @property integer $apartment_layout_id
 * @property integer $condition_id
 * @property integer $bathroom_count
 * @property double $ceiling_height
 * @property integer $year_build
 * @property string $description
 * @property string $description_for_site
 * @property string $description_near
 * @property string $rented_with
 * @property string $rented_to
 *
 * @property City $city
 * @property Contact $contact
 * @property Contractor $contractor
 * @property Country $country
 * @property RealEstateCategory $category
 * @property RealEstateSubCategory $subCategory
 * @property RealEstateTarget $target
 * @property Region $region
 * @property User $createdBy
 * @property User $owner
 * @property RealEstateObjectFeature $realEstateObjectFeature
 * @property RealEstateFeature[] $realEstateFeatures
 */
class RealEstate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'real_estate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['target_id', 'category_id', 'sub_category_id', 'created_by', 'created_at', 'country_id', 'region_id', 'city_id', 'address'], 'required'],
            [['target_id', 'category_id', 'sub_category_id', 'created_by', 'owner_id', 'contractor_id', 'contact_id', 'room_count', 'floor', 'floors', 'updated_by', 'price', 'price_hidden', 'auction', 'is_rented', 'is_deleted', 'to_site', 'for_export', 'country_id', 'region_id', 'city_id', 'build_material_id', 'apartment_layout_id', 'condition_id', 'bathroom_count', 'year_build'], 'integer'],
            [['square_all', 'square_living', 'square_kitchen', 'square_balcony', 'square_bathroom', 'lat', 'lng', 'ceiling_height'], 'number'],
            [['created_at', 'updated_at', 'date_sale', 'rented_with', 'rented_to'], 'safe'],
            [['status', 'description', 'description_for_site', 'description_near'], 'string'],
            [['address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'target_id' => 'Тип недвижимости',
            'category_id' => 'Category ID',
            'sub_category_id' => 'Sub Category ID',
            'created_by' => 'Создатель',
            'owner_id' => 'Владелец',
            'contractor_id' => 'Клиент',
            'contact_id' => 'Contact ID',
            'room_count' => 'Количество комнат',
            'floor' => 'Этаж',
            'floors' => 'Этажность здания',
            'square_all' => 'Площадь общая',
            'square_living' => 'Площадь жилая',
            'square_kitchen' => 'Площадь кухни',
            'square_balcony' => 'Площадь балкона',
            'square_bathroom' => 'Площадь санузла',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'updated_by' => 'Кем изменено',
            'status' => 'Опубликован',
            'date_sale' => 'Дата продажи',
            'price' => 'Цена',
            'price_hidden' => 'Price Hidden',
            'auction' => 'Торг уместен',
            'is_rented' => 'Is Rented',
            'is_deleted' => 'Is Deleted',
            'to_site' => 'На сайт',
            'for_export' => 'Для выгрузки',
            'country_id' => 'Страна',
            'region_id' => 'Регион',
            'city_id' => 'Город',
            'address' => 'Адрес',
            'lat' => 'Широта',
            'lng' => 'Долгота',
            'build_material_id' => 'Build Material ID',
            'apartment_layout_id' => 'Apartment Layout ID',
            'condition_id' => 'Condition ID',
            'bathroom_count' => 'Количество балконов',
            'ceiling_height' => 'Высота потолков',
            'year_build' => 'Дата постройки',
            'description' => 'Описание',
            'description_for_site' => 'Описание для сайта',
            'description_near' => 'Что находитс рядом',
            'rented_with' => 'Rented With',
            'rented_to' => 'Rented To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['ID' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(RealEstateCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(RealEstateSubCategory::className(), ['id' => 'sub_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarget()
    {
        return $this->hasOne(RealEstateTarget::className(), ['id' => 'target_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstateObjectFeature()
    {
        return $this->hasOne(RealEstateObjectFeature::className(), ['real_estate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstateFeatures()
    {
        return $this->hasMany(RealEstateFeature::className(), ['id' => 'real_estate_feature_id'])->viaTable('real_estate_object_feature', ['real_estate_id' => 'id']);
    }
}
