<?php

use yii\caching\FileCache;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;
use yii\swiftmailer\Mailer;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

Yii::setAlias('@webroot', dirname(__DIR__, 2));
Yii::setAlias('@web', '/');

$config = [
    'name' => $params['appName'],
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
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
        'cache' => [
            'class' => FileCache::class,
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
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => FixtureController::class,
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
    ];
}

return $config;