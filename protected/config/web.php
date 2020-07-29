<?php

use app\models\User;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\caching\FileCache;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;
use yii\swiftmailer\Mailer;
use yii\web\JqueryAsset;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

Yii::setAlias('@webroot', dirname(__DIR__, 2));
Yii::setAlias('@web', '/');

$config = [
    'name' => $params['appName'],
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@backups' => '@app/backups',
        '@upload_path' => '@webroot/upload',
        '@upload_web' => '@web/upload',
    ],
    'language' => $params['language'],
    'container' => [
        'definitions' => [
        ],
        'singletons' => [
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                ],
                'test' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                ],
            ]
        ],
        'request' => [
            'csrfParam' => 'ckCsrfToken',
            'enableCsrfValidation' => true,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jXBjnr3ByJb-0lXBxhfZfYKKGdqkXb-X',
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => YII_DEBUG,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
//                'email' => [
//                    'class' => EmailTarget::class,
//                    'levels' => ['error', 'warning'],
//                    'message' => [
//                        'to' => $params['adminEmail'],
//                        'from' => $params['supportEmail'],
//                    ],
//                ],
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'forceCopy' => YII_ENV_DEV,
            'bundles' => [
                JqueryAsset::class => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ],
                ],
                BootstrapAsset::class => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ],
                ],
                BootstrapPluginAsset::class => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.bundle.js' : 'js/bootstrap.bundle.min.js',
                    ],
                ],
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => YII_ENV_TEST,
            'rules' => [
            ],
        ],
        */
        'db' => $db,
    ],
    'params' => $params,
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

return $config;
