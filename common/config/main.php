<?php
return [
    'language' => 'ru-RU',
    'name' => 'ЭИОС ГПА',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
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
];
