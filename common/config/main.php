<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => yii\helpers\ArrayHelper::merge(require(__DIR__ . '/../../vendor/yiisoft/extensions.php'), require(__DIR__ . '/../../vendor/siasoft/extensions.php')),
    'language' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'modules' => [
        'qucms' => [
            'class' => 'siasoft\qucms\Module'],
        'realEstate' => [
            'class' => 'siasoft\qucms\modules\realEstate\Module',
        ],
    ]
];
