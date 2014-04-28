<?php

namespace backend\controllers;

class SiteController extends \siasoft\qucms\web\Controller
{
    public function actionIndex()
    {
        $this->redirect(\Yii::$app->urlManager->createUrl(['qucms']));
    }

}
