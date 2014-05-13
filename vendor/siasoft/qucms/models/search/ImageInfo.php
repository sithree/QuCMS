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
            [['id', 'section', 'original', 'width', 'height', 'size'], 'integer'],
            [['title', 'name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ImageInfoModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'section' => $this->section,
            'original' => $this->original,
            'width' => $this->width,
            'height' => $this->height,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
