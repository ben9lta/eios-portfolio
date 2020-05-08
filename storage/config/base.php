<?php

return [
    'id' => 'storage',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => [
            'class'           => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'baseUrl'         => 'http://storage.eios-portfolio/',
            'rules'           => [

            ],
        ],
        'request' => [
            'baseUrl' => '/storage/web',
        ],
    ],
];