<?php

namespace siasoft\qucms\controllers;

class PermissionController extends \siasoft\qucms\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', ["items" => \siasoft\qucms\models\AuthItem::find()->with('authItemChild')->all()]);
    }

}
