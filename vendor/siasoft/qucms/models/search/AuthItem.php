<?php

namespace siasoft\qucms\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use siasoft\qucms\models\AuthItem as AuthItemModel;

/**
 * AuthItem represents the model behind the search form about `backend\models\AuthItem`.
 */
class AuthItem extends AuthItemModel
{

    public function rules()
    {
        return [
            [['name', 'description', 'rule_name', 'data'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    protected function search($params, $query)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'rule_name', $this->rule_name])
                ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }

    public function searchPermissions($params)
    {
        return $this->search($params, AuthItemModel::find()->permissions());
    }

    public function searchRoles($params)
    {
        return $this->search($params, AuthItemModel::find()->roles());
    }
}
