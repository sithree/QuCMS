<?php

namespace siasoft\qucms\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use siasoft\qucms\models\ImageInfo as ImageInfoModel;

/**
 * ImageInfo represents the model behind the search form about `siasoft\qucms\models\ImageInfo`.
 */
class ImageInfo extends ImageInfoModel
{

    public function rules()
    {
        return [
            [['id', 'section', 'width', 'height', 'size'], 'integer'],
            [['title', 'source.name', 'source.source', 'source.url', 'source.author'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'source.name',
            'source.source',
            'source.url',
            'source.author'
        ]);
    }

    public function search($params)
    {
        $query = ImageInfoModel::find()->joinWith([
            'source' => function($q) {
        $q->from(['source' => 'image_source']);
    }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['source.name'] = [
            'asc' => ['source.name' => SORT_ASC],
            'desc' => ['source.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['source.source'] = [
            'asc' => ['source.source' => SORT_ASC],
            'desc' => ['source.source' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['source.url'] = [
            'asc' => ['source.url' => SORT_ASC],
            'desc' => ['source.url' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['source.author'] = [
            'asc' => ['source.author' => SORT_ASC],
            'desc' => ['source.author' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'section' => $this->section,
            'width' => $this->width,
            'height' => $this->height,
            'size' => $this->size
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'source.name', $this->getAttribute('source.name')])
                ->andFilterWhere(['like', 'source.source', $this->getAttribute('source.source')])
                ->andFilterWhere(['like', 'source.url', $this->getAttribute('source.url')])
                ->andFilterWhere(['like', 'source.author', $this->getAttribute('source.author')]);
        //->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}
