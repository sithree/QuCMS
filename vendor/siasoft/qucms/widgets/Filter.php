<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\widgets;

use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

/**
 * Description of Filter
 *
 * @author SW-PC1
 */
class Filter extends Widget
{
    /**
     *
     * @var \yii\base\Model
     */
    public $searchModel;
    /**
     *
     * @var \yii\data\ActiveDataProvider
     */
    public $dataProvider;

    public function init()
    {
        parent::init();
        if (!isset($this->searchModel) || !isset($this->dataProvider))
            throw new \yii\base\InvalidConfigException();
    }

    public function renderItems($items)
    {
        if (!isset($items[0])) {
            foreach ($items as $key => $value) {
                echo "$key equal $value <br/>";
            }
        } else {
            list($operator, $left, $right) = $items;
            switch ($operator) {
                case 'or':
                case 'and' :
                    $this->renderItems($left);
                    echo \yii\helpers\Html::dropDownList('condition', $operator, ['and', 'or']);
                    $this->renderItems($right);
                    echo '<br/>';
                    break;
                case 'like' :
                    echo \yii\helpers\Html::dropDownList('condition', $left, $this->searchModel->attributeLabels()) . " - $operator - $right";
            }
        }
    }

    public function run()
    {
        if (!isset($this->dataProvider->query->where)) {
            return;
        }
        $this->renderItems($this->dataProvider->query->where);
    }

}
