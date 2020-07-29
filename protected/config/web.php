<?php

use app\models\User;
use borales\extensions\phoneInput\PhoneInputAsset;
use kartik\editors\assets\CodemirrorAsset;
use kartik\editors\assets\CodemirrorFormatterAsset;
use kartik\editors\assets\SummernoteAsset;
use kartik\icons\FontAwesomeAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\caching\FileCache;
use yii\helpers\ArrayHelper;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;
use yii\swiftmailer\Mailer;
use yii\web\JqueryAsset;
use yii\widgets\LinkPager;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

Yii::setAlias('@webroot', dirname(__DIR__, 2));
Yii::setAlias('@web', '/');

$config = [
    'name' => $params['appName'],
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ArrayHelper::merge(['log'], array_keys(require __DIR__ . '/modules.php')),
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
            LinkPager::class => [
                'class' => \app\widgets\LinkPager\LinkPager::class,
                'lastPageLabel' => true,
                'firstPageLabel' => true,
                'jumpPageLabel' => true,
            ],
            yii\bootstrap4\LinkPager::class => [
                'class' => \app\widgets\LinkPager\LinkPager::class,
                'lastPageLabel' => true,
                'firstPageLabel' => true,
                'jumpPageLabel' => true,
            ],
        ],
    ],
    'modules' => require __DIR__ . '/modules.php',
    'components' => [
        'formatter' => [
            'datetimeFormat' => 'Y-MM-dd HH:mm:ss',
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
                SummernoteAsset::class => [
//                    'baseUrl' => '//cdn.jsdelivr.net/npm/summernote@0.8.18/dist',
                    'sourcePath' => '@bower/summernote/dist',
                    'js' => [
                        YII_ENV_DEV ? 'summernote-bs4.js' : 'summernote-bs4.min.js',
                    ],
                    'css' => [
                        YII_ENV_DEV ? 'summernote-bs4.css' : 'summernote-bs4.min.css',
                    ],
                ],
                CodemirrorAsset::class => [
//                    'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.55.0',
                    'sourcePath' => '@bower/codemirror',
                    'publishOptions' => [
                        'only' => [
                            'lib/*',
                            'addon/*',
                            'addon/*/*',
                            'mode/*',
                            'mode/*/*',
                            'theme/*',
                            'keymap/*',
                        ],
                    ],
                    'js' => [
                        'lib/codemirror.js',
                    ],
                    'css' => [
                        'lib/codemirror.css',
                    ],
                ],
                CodemirrorFormatterAsset::class => [
//                    'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/codemirror/2.38.0',
                    'sourcePath' => '@npm/codemirror/lib/util',
                ],
                PhoneInputAsset::class => [
//                    'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/codemirror/2.38.0',
                    'sourcePath' => '@bower/intl-tel-input/build',
                    'js' => [
                        'js/utils.js',
                        'js/intlTelInput-jquery.js',
                    ],
                    'css' => [
                        'css/intlTelInput.css',
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
