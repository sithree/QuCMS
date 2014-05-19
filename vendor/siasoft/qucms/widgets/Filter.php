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
class Filter extends Widget {

    public static $operators = [
        'less' => '<',
        'lessorequal' => '<=',
        'greater' => '>',
        'greaterorequal' => '>=',
        'equal' => '=',
        'notequal' => '<>',
        'beetween' => 'между',
        'in' => 'в',
        'like' => 'содержит'
    ];
    public static $conditions = [
        'not' => 'не',
        'and' => 'и',
        'or' => 'или'
    ];
    private $_attributes;

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

    public function init() {
        parent::init();
        if (!isset($this->searchModel) || !isset($this->dataProvider))
            throw new \yii\base\InvalidConfigException();
    }

    public function getAttributes() {
        if (!isset($this->_attributes)) {
            $attributes = [];
            foreach ($this->searchModel->attributes as $key => $value) {
                $attributes[$key] = $this->searchModel->getAttributeLabel($key);
            }
            $this->_attributes = $attributes;
        }
        return $this->_attributes;
    }

    public function renderItems($items) {
        list($operator) = $items;
        switch ($operator) {
            case 'or':
            case 'and':
            case 'not':
                echo "<div class=\"condition-block condition-$operator\"><div class=\"items\">";
                for ($i = 1; $i < count($items); $i++) {
                    $this->renderItems($items[$i]);
                }
                echo '</div><div class="operator"><div>' . \yii\helpers\Html::dropDownList('condition', $operator, self::$conditions, ['class' => 'form-control input-sm']) . '</div></div>';
                echo '</div>';
                break;
            case 'less':
            case 'lessorequal':
            case 'greater':
            case 'greaterorequal':
            case 'equal':
            case 'notequal':
            case 'like':
                list(, $left, $right) = $items;
                echo '<div class="condition">';
                echo \yii\helpers\Html::dropDownList('condition', $left, $this->attributes, ['class' => 'form-control input-sm'])
                . \yii\helpers\Html::dropDownList('operator', $operator, self::$operators, ['class' => 'form-control input-sm'])
                . \yii\helpers\Html::textInput('value', $right, ['class' => 'form-control input-sm']);
                echo '</div>';
                break;
        }
    }

    public function run() {
        echo '<div id="filter"/>';
        $this->renderItems([
            'and',
            ['greater', 'id', 5],
            [
                'and',
                [
                    'or',
                    [
                        'not',
                        ['like', 'source.name', 'hello'],
                        ['equal', 'section', 1],
                        ['less', 'size', 1500]
                    ],
                    ['equal', 'section', 1]
                ],
                ['less', 'size', 1500]
            ]
        ]);
        echo '</div>';
    }

}
