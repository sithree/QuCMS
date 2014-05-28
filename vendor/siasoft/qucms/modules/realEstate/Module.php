<?php

namespace siasoft\qucms\moduels\realEstate;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'siasoft\qucms\moduels\realEstate\controllers';

    public function init()
    {
        parent::init();
        \Yii::$app->on(\siasoft\qucms\Module::ADMIN_MENU_GENERATION, [$this, 'getMenu']);
    }

    public function getMenu(\yii\base\Event $event)
    {
        $event->data = [
                    ['label' => 'Недвижимость <i class="fa fa-angle-double-down i-right"></i>', 'items' => [
                            ['label' => 'список', 'url' => ['/qucms/image/index']]
                        ]
                    ]
        ];
    }

}
