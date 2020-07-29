<?php

use app\models\User;
use borales\extensions\phoneInput\PhoneInputAsset;
use kartik\editors\assets\CodemirrorAsset;
use kartik\editors\assets\CodemirrorFormatterAsset;
use kartik\editors\assets\SummernoteAsset;
use kartik\icons\FontAwesomeAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\grid\GridView;
use yii\i18n\PhpMessageSource;
use yii\swiftmailer\Mailer;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

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
    'bootstrap' => require __DIR__ . '/modules.php',
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
            ActiveForm::class => [
                'enableClientValidation' => false,
            ],
            yii\bootstrap4\ActiveForm::class => [
                'enableClientValidation' => false,
            ],
        ],
        'singletons' => [
            LinkPager::class => [
                'class' => \app\widgets\LinkPager\LinkPager::class,
                'lastPageLabel' => true,
                'firstPageLabel' => true,
                'jumpPageLabel' => true,
            ],
            \yii\bootstrap4\LinkPager::class => [
                'class' => \app\widgets\LinkPager\LinkPager::class,
                'lastPageLabel' => true,
                'firstPageLabel' => true,
                'jumpPageLabel' => true,
            ],
            GridView::class => [
                'layout' => "{pager}\n{summary}\n{items}\n{pager}",
            ],
        ],
    ],
    'modules' => require __DIR__ . '/modules.php',
    'components' => [
        'formatter' => [
            'datetimeFormat' => 'Y-MM-dd HH:mm:ss',
        ],
        'view' => [
            'theme' => $params['theme'],
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
