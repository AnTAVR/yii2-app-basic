<?php

use app\models\User;
use kartik\icons\FontAwesomeAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\i18n\PhpMessageSource;
use yii\swiftmailer\Mailer;
use yii\web\JqueryAsset;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

Yii::setAlias('@webroot', dirname(__DIR__, 2));
Yii::setAlias('@web', '/');

/**
 * Application configuration shared by all test types
 */
return [
    'name' => $params['appName'],
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@backups' => '@app/backups',
        '@upload_path' => '@webroot/upload',
        '@upload_web' => '@web/upload',
    ],
    'language' => 'en-US',
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
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            'scriptFile' => dirname(__DIR__, 2) . '/index-test.php',
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
        'user' => [
            'identityClass' => User::class,
        ],
        'mailer' => [
            'class' => Mailer::class,
            'useFileTransport' => true,
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
                FontAwesomeAsset::class => [
//                    'baseUrl' => '//use.fontawesome.com/releases/v5.14.0',
                    'sourcePath' => '@bower/fontawesome',
                    'publishOptions' => [
                        'only' => [
                            'css/*',
                            'js/*',
                            'webfonts/*',
                        ]
                    ],
                    'js' => [
//                        YII_ENV_DEV ? 'js/all.js' : 'js/all.min.js',
                    ],
                    'css' => [
                        YII_ENV_DEV ? 'css/all.css' : 'css/all.min.css',
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
