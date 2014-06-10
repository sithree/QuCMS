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
class ClassHelper
{
    private static $classes;

    private static function getTokenIndex($tokens, $token, $offset = 0)
    {
        if (is_string($token)) {
            return ArrayHelper::search($tokens, $token, null, true, $offset);
        }
        return ArrayHelper::search($tokens, $token, function($value, $token) {
                    return is_array($value) && $value[0] === $token;
                }, true, $offset);
    }
    
    private static function getUses($tokens, $offset = 0) {
        
    }

    private static function getOperator($tokens, $startToken, &$offset = 0, $endToken = ';')
    {
        $start = self::getTokenIndex($tokens, $startToken, $offset) + 1;
        if ($start === 0) {
            return '';
        }
        $end = self::getTokenIndex($tokens, $endToken, $start);
        if ($end === 0) {
            return '';
        }
        $offset = $end;
        $result = array_slice($tokens, $start, $end - $start + 1);
        return trim(implode(ArrayHelper::getColumn($result, 1)));
    }

    private static function findClasses()
    {
        $files = array_merge(FileHelper::findFiles(Yii::$app->basePath, '*.php'), FileHelper::findFiles(Yii::$app->vendorPath, '*.php'));
        array_walk($files, function(&$value) {
            //$file = token_get_all(file_get_contents($value, null, null, 0));
//            $offset = 0;
//            $uses = [];
//
//            $class = self::getOperator($file, T_CLASS, $offset, T_STRING);
//            if (!$class) {
//                $value = false;
//                return;
//            }
//            $head = array_slice($file, 0, $offset);
//            $eoffset = 0;
//            $base = self::getOperator(array_slice($file, $offset, self::getTokenIndex($file, '{', $offset) - $offset + 2), T_EXTENDS, $eoffset, '{');
//
//            $hoffset = 0;
//            $namespace = self::getOperator($head, T_NAMESPACE, $hoffset);
//            while ($use = self::getOperator($head, T_USE, $hoffset)) {
//                $uses[] = $use;
//            }
//
//            $value = [
//                'class' => $namespace . ($namespace ? '\\' : '') . $class,
//                'base' => $base,
//                'uses' => $uses,
//                'file' => $value
//            ];
            $value = new \siasoft\qucms\web\FileReflector($value);
        });
        return array_filter($files);
    }

    private static function getClassesInternal()
    {
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

    public static function getClasses($baseClass)
    {
        return array_filter(static::getClassesInternal(), function($value) use($baseClass) {
            return true; // $value['base'] === $baseClass;
        });
    }

}
