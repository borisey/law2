<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'language' => 'ru-RU',
    'id' => 'basic',
    'name' => 'Law2.ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'LkPnW1Q90fBFagKGmz7HZSn5YgDlkJF1',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
        'db' => $db,

        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '' => 'bill/bills',
                'page<page:\d+>' => 'bill/bills',
                'public_discussion' => 'public-discussion/bills',
                'public_discussion/<id:\d+>' => 'public-discussion/bill',
                'consideration' => '/consideration/bills',
                'complete' => '/complete/bills',
                'sign' => '/sign/bills',
                'cancel' => '/cancel/bills',
                'deputy/<id:\d+>/page<page:\d+>' => 'deputy/deputy',
                'deputy/<id:\d+>' => 'deputy/deputy',
                'deputy' => '/deputy/deputies',
                'committee' => 'committee/committees',
                'committee/<id:\d+>/page<page:\d+>' => 'committee/committee',
                'committee/<id:\d+>' => 'committee/committee',
                '<id:(\d+[^/]+)>' => 'bill/bill',
                'gov' => '/gov/govs',
                'gov/<id:\d+>' => 'gov/gov',
                'sitemap_bill_1.xml' => 'site/sitemap',
                'sitemap_public_discussion_1.xml' => 'site/sitemap-public-discussion',
                'novapress' => 'site/novapress',
            ]
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;