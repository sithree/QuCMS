<?php

namespace siasoft\qucms\controllers;

use Yii;
use yii\filters\AccessControl;
use siasoft\qucms\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render();
    }



}
