<?php

use yii\caching\FileCache;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;
use yii\rbac\DbManager;
use yii\swiftmailer\Mailer;
use yii\web\User;

$params = require __DIR__ . '/params.php';

return [
    'name' => $params['appName'],
    'basePath' => dirname(__DIR__),
    'aliases' => require __DIR__ . '/aliases.php',
    'modules' => require __DIR__ . '/modules.php',
    'params' => $params,
    'components' => [
        'formatter' => [
            'datetimeFormat' => 'Y-MM-dd HH:mm:ss',
        ],
        'user' => [
            'class' => User::class,
            'identityClass' => \app\modules\account\models\User::class,
            'enableAutoLogin' => true,
            'loginUrl' => ['/site/login'],
        ],
        'authManager' => [
            'class' => DbManager::class,
//            'defaultRoles' => ['users-role'],
            'cache' => YII_ENV_DEV ? null : 'cache',
        ],
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
        'mailer' => [
            'class' => Mailer::class,
            'useFileTransport' => YII_DEBUG,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => YII_ENV_TEST,
            'rules' => [
            ],
        ],
        'cache' => [
            'class' => FileCache::class,
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

        'assetManager' => require __DIR__ . '/asset_manager.php',
        'view' => [
            'theme' => $params['theme'],
        ],
    ],
];
