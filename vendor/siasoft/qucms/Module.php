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
        $event->data = [];
        $data = [
            ['label' => 'cms', 'url' => ['/qucms/default/index']],
            ['label' => 'Доступ <i class="fa fa-angle-double-down i-right"></i>', 'items' => [
                    ['label' => 'Пользователи', 'url' => ['/qucms/user/index']],
                    ['label' => 'Роли', 'url' => ['/qucms/role/index']],
                    ['label' => 'Разрешения', 'url' => ['/qucms/permission/index']]
                ]],
            ['label' => 'Изображения <i class="fa fa-angle-double-down i-right"></i>', 'items' => [
                    ['label' => 'Настройки', 'url' => ['/qucms/image/index']],
                    ['label' => 'Проверка загрузки', 'url' => ['/qucms/image/upload']],
                    ['label' => 'Разделы', 'url' => ['/qucms/image-section/index']]
                ]
            ]
        ];
        \Yii::$app->trigger(self::ADMIN_MENU_GENERATION, $event);
        return \yii\helpers\ArrayHelper::merge($data, $event->data);
    }

}
