<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\helpers;

use \Yii;

/**
 * Description of ClassHelper
 *
 * @author XPyct
 */
class ClassHelper {

    private static $classes;

    private static function findClasses() {
        $files = array_merge(FileHelper::findFiles(Yii::$app->basePath, '*.php'), FileHelper::findFiles(Yii::$app->vendorPath, '*.php'));
        array_walk($files, function(&$value) {
            $class = '';
            $parent = '';
            $matches = [];
            $file = file_get_contents($value);
            if (preg_match('/(?<=\snamespace)\s+\S+\s*(?=;)/', $file, $matches)) {
                $class = trim(array_shift($matches)) . '\\';
            }
            if (preg_match('/(?<=\sclass)\s+\w+/', $file, $matches)) {
                $class .= trim(array_shift($matches));
            } else {
                $value = false;
                return;
            }

            if (preg_match('/(?<=\sextends)\s+\S+\s*(?={)/', $file, $matches)) {
                $parent = trim(array_shift($matches));
            }

            if (preg_match_all('/(?<=\suse)\s+\S+\s*(?=;)/', $file, $matches)) {
                $key = preg_quote($parent);
                $fullName = preg_grep("/{$key}\s*/", array_shift($matches));
                if ($fullName) {
                    $parent = trim(array_shift($fullName));
                }
            }

            $value = [
                'class' => $class,
                'parent' => $parent,
                'path' => $value
            ];
        });
        return array_filter($files);
    }

    private static function getClassesInternal() {
        if (!static::$classes) {
            $classesFile = Yii::$app->runtimePath . DIRECTORY_SEPARATOR . 'classes.php';
            if (file_exists($classesFile)) {
                static::$classes = (require $classesFile);
                return static::$classes;
            }
            $classes = static::findClasses();
            file_put_contents($classesFile, '<?php return ' . var_export($classes, true) . ';');
            return static::$classes = $classes;
        }
        return static::$classes;
    }

    public static function getClasses($baseClass) {

        return static::getClassesInternal();
    }

}
