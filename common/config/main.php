<?php
return [
    'language' => 'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'name' => 'ЭИОС ГПА',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'formatter' => [
            'dateFormat' => 'd.MM.yyyy',
            'timeFormat' => 'H:mm:ss',
            'datetimeFormat' => 'd.MM.yyyy H:mm',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//        ],
    ],
    'container' => [
        'definitions' => [
            'yii\widgets\LinkPager' => \yii\bootstrap4\LinkPager::class,
        ]
    ],
];
