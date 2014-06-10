<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\helpers;

/**
 * Description of ArrayHelper
 *
 * @author SW-PC1
 */
class ArrayHelper extends \yii\helpers\ArrayHelper
{

    public static function search(array $array, $value, $callback = null, $first = true, $offset = 0)
    {
        if ($offset === -1) {
            return -1;
        }
        if (!$callback) {
            $callback = function($value1, $value2) {
                return $value1 === $value2;
            };
        }
        $result = [];
        for ($i = $offset; $i < count($array); $i++) {
            if ($callback($array[$i], $value)) {
                if ($first) {
                    return $i;
                }
                $result[] = $i;
            }
        }
        if ($first) {
            return -1;
        }
        return $result;
    }

}
