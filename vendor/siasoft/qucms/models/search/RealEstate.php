<?php

namespace siasoft\qucms\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use siasoft\qucms\models\RealEstate as RealEstateModel;

/**
 * RealEstate represents the model behind the search form about `siasoft\qucms\models\RealEstate`.
 */
class RealEstate extends RealEstateModel
{

    public function rules()
    {
        return [
            [['ID', 'operation_id', 'type_id', 'created_by', 'owner', 'customer_id', 'floor', 'floors', 'bathroom_count', 'room_count', 'updated_by', 'is_active', 'for_export', 'to_site', 'is_elite', 'is_deleted', 'is_saled', 'is_draft', 'price', 'price_hidden', 'auction', 'contract_id', 'ID_country', 'ID_region', 'ID_city', 'address', 'is_new_building', 'year_build'], 'integer'],
            [['square_all', 'square_living', 'square_kitchen', 'square_balcony', 'square_bathroom', 'ceiling_height'], 'number'],
            [['created_at', 'updated_at', 'date_deleted', 'date_sale', 'rented_from', 'rented_to', 'description', 'description_for_site', 'description_near', 'сompletion_date', 'lat', 'lng'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RealEstateModel::find(); //->select([ 'ID',
//            'operation_id',
//            'type_id',
//            'created_by',
//            'owner',
//            'customer_id',
//            'floor',
//            'floors',
//            'square_all',
//            'square_living',
//            'square_kitchen',
//            'square_balcony',
//            'square_bathroom',
//            'bathroom_count',
//            'ceiling_height',
//            'room_count',
//            'created_at',
//            'updated_at',
//            'updated_by']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID' => $this->ID,
            'operation_id' => $this->operation_id,
            'type_id' => $this->type_id,
            'created_by' => $this->created_by,
            'owner' => $this->owner,
            'customer_id' => $this->customer_id,
            'floor' => $this->floor,
            'floors' => $this->floors,
            'square_all' => $this->square_all,
            'square_living' => $this->square_living,
            'square_kitchen' => $this->square_kitchen,
            'square_balcony' => $this->square_balcony,
            'square_bathroom' => $this->square_bathroom,
            'bathroom_count' => $this->bathroom_count,
            'ceiling_height' => $this->ceiling_height,
            'room_count' => $this->room_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_active' => $this->is_active,
            'for_export' => $this->for_export,
            'to_site' => $this->to_site,
            'is_elite' => $this->is_elite,
            'is_deleted' => $this->is_deleted,
            'date_deleted' => $this->date_deleted,
            'date_sale' => $this->date_sale,
            'is_saled' => $this->is_saled,
            'is_draft' => $this->is_draft,
            'price' => $this->price,
            'price_hidden' => $this->price_hidden,
            'auction' => $this->auction,
            'rented_from' => $this->rented_from,
            'rented_to' => $this->rented_to,
            'contract_id' => $this->contract_id,
            'ID_country' => $this->ID_country,
            'ID_region' => $this->ID_region,
            'ID_city' => $this->ID_city,
            'address' => $this->address,
            'is_new_building' => $this->is_new_building,
            'сompletion_date' => $this->сompletion_date,
            'year_build' => $this->year_build,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'description_for_site', $this->description_for_site])
                ->andFilterWhere(['like', 'description_near', $this->description_near])
                ->andFilterWhere(['like', 'lat', $this->lat])
                ->andFilterWhere(['like', 'lng', $this->lng]);

        return $dataProvider;
    }

}
