<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\helpers;

/**
 * Description of AssetHelper
 *
 * @author XPyct
 */
class AssetHelper {
    public static function getInfo($path) {
        $file = file_get_contents($path);
        if (preg_match('/(?<=\sextends)\s+\S*/', $file, $matches) > 0) {
            $class = trim(array_shift($matches));
            if ($class !== '\yii\web\AssetBundle') {
                if (preg_match_all('/(?<=\suse)\s+\S*;/', $file, $uses)) {
                    $class = preg_quote($class);
                    if (in_array(' yii\web\AssetBundle;', preg_grep("/{$class};$/", array_shift($uses)))) {
                    }
                }
                unset($asstets[$i]);
            }
        }
    }

}
