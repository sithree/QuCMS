<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\helpers;

/**
 * Description of FileHelper
 *
 * @author XPyct
 */
class FileHelper {

    public static function findFiles($path, $pattern = '*', $flags = GLOB_NOSORT) {
        $matches = array();
        $folders = array(rtrim($path, DIRECTORY_SEPARATOR));

        while ($folder = array_shift($folders)) {
            $matches = array_merge($matches, glob($folder . DIRECTORY_SEPARATOR . $pattern, $flags));
            $moreFolders = glob($folder . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
            $folders = array_merge($folders, $moreFolders);
        }
        return $matches;
    }

}
