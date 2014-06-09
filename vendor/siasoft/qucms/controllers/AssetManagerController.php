<?php

namespace siasoft\qucms\controllers;

use \yii\helpers\FileHelper;
use \Yii;

class AssetManagerController extends \siasoft\qucms\web\Controller
{

    private function bfglob($path, $pattern = '*', $flags = GLOB_NOSORT)
    {
        $matches = array();
        $folders = array(rtrim($path, DIRECTORY_SEPARATOR));

        while ($folder = array_shift($folders)) {
            $matches = array_merge($matches, glob($folder . DIRECTORY_SEPARATOR . $pattern, $flags));
            $moreFolders = glob($folder . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
            $folders = array_merge($folders, $moreFolders);
        }
        return $matches;
    }

    public function actionIndex()
    {
        $patern = '*Asset*.php';
        $asstets = array_merge($this->bfglob(Yii::$app->basePath, $patern), $this->bfglob(Yii::$app->vendorPath, $patern));
        $matches = $uses = [];
        for ($i = count($asstets) - 1; $i > -1; $i--) {
            $file = file_get_contents($asstets[$i]);
            if (preg_match('/(?<=\sextends)\s+\S*/', $file, $matches) > 0) {
                $class = trim(array_shift($matches));
                if ($class !== '\yii\web\AssetBundle') {
                    if (preg_match_all('/(?<=\suse)\s+\S*;/', $file, $uses)) {
                        $class = preg_quote($class);
                        if (in_array(' yii\web\AssetBundle;', preg_grep("/{$class};$/", array_shift($uses)))) {
                            continue;
                        }
                    }
                    unset($asstets[$i]);
                }
            }
        }
        return $this->render('index', ['assets' => $asstets]);
    }

}
