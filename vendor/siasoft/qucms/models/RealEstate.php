<?php

namespace siasoft\qucms\models;

use Yii;

/**
 * This is the model class for table "real_estate".
 *
 * @property integer $ID
 * @property integer $operation_id
 * @property integer $type_id
 * @property integer $created_by
 * @property integer $owner
 * @property integer $customer_id
 * @property integer $floor
 * @property integer $floors
 * @property string $square_all
 * @property string $square_living
 * @property string $square_kitchen
 * @property string $square_balcony
 * @property string $square_bathroom
 * @property integer $bathroom_count
 * @property double $ceiling_height
 * @property integer $room_count
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $is_active
 * @property integer $for_export
 * @property integer $to_site
 * @property integer $is_elite
 * @property integer $is_deleted
 * @property string $date_deleted
 * @property string $date_sale
 * @property integer $is_saled
 * @property integer $is_draft
 * @property integer $price
 * @property integer $price_hidden
 * @property integer $auction
 * @property string $rented_from
 * @property string $rented_to
 * @property string $description
 * @property string $description_for_site
 * @property string $description_near
 * @property integer $contract_id
 * @property integer $ID_country
 * @property integer $ID_region
 * @property integer $ID_city
 * @property integer $address
 * @property integer $is_new_building
 * @property string $сompletion_date
 * @property string $lat
 * @property string $lng
 * @property integer $year_build
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
            [['operation_id', 'type_id', 'created_by', 'customer_id', 'floor', 'floors', 'square_all', 'created_at'], 'required'],
            [['operation_id', 'type_id', 'created_by', 'owner', 'customer_id', 'floor', 'floors', 'bathroom_count', 'room_count', 'updated_by', 'is_active', 'for_export', 'to_site', 'is_elite', 'is_deleted', 'is_saled', 'is_draft', 'price', 'price_hidden', 'auction', 'contract_id', 'ID_country', 'ID_region', 'ID_city', 'address', 'is_new_building', 'year_build'], 'integer'],
            [['square_all', 'square_living', 'square_kitchen', 'square_balcony', 'square_bathroom', 'ceiling_height'], 'number'],
            [['created_at', 'updated_at', 'date_deleted', 'date_sale', 'rented_from', 'rented_to', 'сompletion_date'], 'safe'],
            [['description', 'description_for_site', 'description_near'], 'string'],
            [['lat', 'lng'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'operation_id' => 'Тип операции',
            'type_id' => 'Тип недвижимости',
            'created_by' => 'Создатель',
            'owner' => 'Owner',
            'customer_id' => 'Клиент',
            'floor' => 'Этаж',
            'floors' => 'Этажность здания',
            'square_all' => 'Площадь общая',
            'square_living' => 'Площадь жилая',
            'square_kitchen' => 'Площадь кухни',
            'square_balcony' => 'Площадь балкона',
            'square_bathroom' => 'Площадь санузла',
            'bathroom_count' => 'Количество балконов',
            'ceiling_height' => 'Высота потолков',
            'room_count' => 'Количество комнат',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'updated_by' => 'Кем изменено',
            'is_active' => 'Опубликован',
            'for_export' => 'Для выгрузки',
            'to_site' => 'На сайт',
            'is_elite' => 'Элитная недвижимость',
            'is_deleted' => 'Удалено',
            'date_deleted' => 'Дата удаления',
            'date_sale' => 'Дата продажи',
            'is_saled' => 'Продано',
            'is_draft' => 'Черновик',
            'price' => 'Цена',
            'price_hidden' => 'Price Hidden',
            'auction' => 'Торг уместен',
            'rented_from' => 'Сдана с',
            'rented_to' => 'Сдана до',
            'description' => 'Описание',
            'description_for_site' => 'Описание для сайта',
            'description_near' => 'Что находитс рядом',
            'contract_id' => 'Договор',
            'ID_country' => 'Страна',
            'ID_region' => 'Регион',
            'ID_city' => 'Город',
            'address' => 'Адрес',
            'is_new_building' => 'Новостройка',
            'сompletion_date' => 'Дата сдачи объекта',
            'lat' => 'Широта',
            'lng' => 'Долгота',
            'year_build' => 'Year Build',
        ];
    }
}
