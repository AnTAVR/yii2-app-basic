<?php

use app\components\Session;
use yii\helpers\ArrayHelper;

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic',
    'language' => $params['language'],
    'bootstrap' => ArrayHelper::merge(['log'], array_keys(require __DIR__ . '/modules.php')),
    'container' => [
        'definitions' => require __DIR__ . '/definitions.php',
        'singletons' => require __DIR__ . '/singletons.php',
    ],

    'components' => [
        'session' => Session::class,

        'db' => require __DIR__ . '/db.php',

        'request' => [
            'csrfParam' => 'ckCsrfToken',
            'enableCsrfValidation' => true,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jXBjnr3ByJb-0lXBxhfZfYKKGdqkXb-X',
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return ArrayHelper::merge(require __DIR__ . '/common.php', $config);
