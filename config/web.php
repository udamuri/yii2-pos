<?php

$params = require(__DIR__ . '/params.php');

use \yii\web\Request;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$config = [
    'id' => 'basic-pos',
    'name' => 'MURI BUDIMAN',
    'language'=>'id',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'product' => [
            'class' => 'app\modules\product\module',
        ],
        'supplier' => [
            'class' => 'app\modules\supplier\module',
        ],
        'purchase' => [ //penjualan
            'class' => 'app\modules\purchase\module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        	'baseUrl' => $baseUrl,
            'cookieValidationKey' => '~!@#$%^&*()_+muribudiman)*&^*%^&^%*',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'mycomponent' => [
            'class' => 'app\components\TaskComponent',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'home'=>'site/index',
                'login'=>'site/login',
                'products'=>'product/site/index',
                'product/create'=>'product/site/create',
                'product/update/<id:[0-9]+>'=>'product/site/update',
                'category'=>'product/site/category',
                'category/create'=>'product/site/category-create',
                'category/update/<id:[0-9]+>'=>'product/site/category-update',
                'suppliers'=>'supplier/site/index',
                'supplier/create'=>'supplier/site/create',
                'supplier/update/<id:[0-9]+>'=>'supplier/site/update',
                'purchase'=>'purchase/site/index'
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
