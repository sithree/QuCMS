<?php

namespace siasoft\qucms\controllers;

use \yii\helpers\FileHelper;
use \Yii;

class AssetManagerController extends \siasoft\qucms\web\Controller {

    public function actionIndex() {
        $asstets = \siasoft\qucms\helpers\ClassHelper::getClasses('\yii\web\AssetBundle');
        return $this->render('index', ['assets' => $asstets]);
    }

    public function actionClearCache() {
        unlink(Yii::$app->runtimePath . DIRECTORY_SEPARATOR . 'classes.php');
        return 'Ok';
    }

}
