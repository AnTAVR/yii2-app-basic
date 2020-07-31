<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$config = [
    'id' => 'basic-tests',
    'language' => 'en-US',
    'bootstrap' => require __DIR__ . '/modules.php',
    'container' => [
        'definitions' => [
            ActiveForm::class => [
                'enableClientValidation' => false,
            ],
            yii\bootstrap4\ActiveForm::class => [
                'enableClientValidation' => false,
            ],
        ],
        'singletons' => require __DIR__ . '/singletons.php',
    ],

    'components' => [
//        'session' => [
//            'class' => Session::class,
////            @todo: Из за установки не работают тесты!!!
//            'savePath' => '@runtime/session',
//        ],

        'db' => require __DIR__ . '/test_db.php',

        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            'scriptFile' => dirname(__DIR__, 2) . '/index-test.php',
        ],
    ],
];

return ArrayHelper::merge(require __DIR__ . '/common.php', $config);
