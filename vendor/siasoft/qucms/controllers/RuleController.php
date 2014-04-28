<?php

namespace siasoft\qucms\controllers;

class RuleController extends \siasoft\qucms\web\Controller
{
    public function actionIndex()
    {
        /* @var $auth \yii\rbac\DbManager */
        foreach (scandir(\Yii::$app->controllerPath) as $class) {
            //if ()
            require \Yii::$app->controllerPath.$class;
        }
        foreach (get_declared_classes() as $class) {
            echo $class.'<br>';            
        }
        return '';
    }

}
