<?php

use yii\bootstrap4\ActiveForm;
use yii\grid\GridView;
use yii\i18n\PhpMessageSource;
use yii\rbac\DbManager;
use yii\swiftmailer\Mailer;
use yii\web\User;
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
//        'session' => [
//            'class' => Session::class,
////            @todo: Из за установки не работают тесты!!!
//            'savePath' => '@runtime/session',
//        ],
        'formatter' => [
            'datetimeFormat' => 'Y-MM-dd HH:mm:ss',
        ],
        'view' => [
            'theme' => $params['theme'],
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
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => dirname(__DIR__) . '/assets',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => YII_ENV_TEST,
            'rules' => [
            ],
        ],
        'user' => [
            'class' => User::class,
            'identityClass' => \app\modules\account\models\User::class,
            'loginUrl' => ['/site/login'],
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
        'db' => $db,
    ],
    'params' => $params,
];
