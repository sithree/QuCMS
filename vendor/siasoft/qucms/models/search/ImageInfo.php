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
            [['title', 'imageSource.name', 'imageSource.source', 'imageSource.url', 'imageSource.author'], 'safe'],
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
            'imageSource.name',
            'imageSource.source',
            'imageSource.url',
            'imageSource.author'
        ]);
    }

    public function search($params)
    {
        $query = ImageInfoModel::find()->joinWith([
            'imageSource' => function($q) {
        $q->from(['imageSource' => 'image_source']);
    }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['imageSource.name'] = [
            'asc' => ['imageSource.name' => SORT_ASC],
            'desc' => ['imageSource.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['imageSource.source'] = [
            'asc' => ['imageSource.source' => SORT_ASC],
            'desc' => ['imageSource.source' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['imageSource.url'] = [
            'asc' => ['imageSource.url' => SORT_ASC],
            'desc' => ['imageSource.url' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['imageSource.author'] = [
            'asc' => ['imageSource.author' => SORT_ASC],
            'desc' => ['imageSource.author' => SORT_DESC],
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
                ->andFilterWhere(['like', 'imageSource.name', $this->getAttribute('imageSource.name')])
                ->andFilterWhere(['like', 'imageSource.source', $this->getAttribute('imageSource.source')])
                ->andFilterWhere(['like', 'imageSource.url', $this->getAttribute('imageSource.url')])
                ->andFilterWhere(['like', 'imageSource.author', $this->getAttribute('imageSource.author')]);
        //->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}
