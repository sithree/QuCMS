<?php

namespace siasoft\qucms;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Module
 *
 * @author SW-PC1
 */
class Module extends \yii\base\Module
{
    const ADMIN_MENU_GENERATION = 'adminMenuGeneration';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'siasoft\qucms\controllers';

    public function init()
    {
        parent::init();
    }

    public static function GetMenu()
    {
        $event = new \yii\base\Event();
        $event->data = [[
        'label' => 'Доступ <i class="fa fa-angle-double-down i-right"></i>', 'items' => [
            ['label' => 'Пользователи', 'url' => ['/qucms/user/index/']],
            ['label' => 'Разрешения', 'url' => ['/qucms/permission/index/']]
        ]]];
        \Yii::$app->trigger(self::ADMIN_MENU_GENERATION, $event);
        return $event->data;
    }

}
