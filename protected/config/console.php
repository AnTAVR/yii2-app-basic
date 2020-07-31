<?php

use app\components\Session;
use bariew\moduleMigration\ModuleMigrateController;
use yii\faker\FixtureController;
use yii\helpers\ArrayHelper;

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic-console',
    'language' => $params['language'],
    'bootstrap' => ArrayHelper::merge(['log'], array_keys(require __DIR__ . '/modules.php')),
    'controllerNamespace' => 'app\commands',
    'container' => [
        'definitions' => [
        ],
        'singletons' => [
        ],
    ],

    'components' => [
        'session' => Session::class,

        'db' => require __DIR__ . '/db.php',
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => ModuleMigrateController::class,
        ],
        'fixture' => [ // Fixture generation command line.
            'class' => FixtureController::class,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
    ];
}

return ArrayHelper::merge(require __DIR__ . '/common.php', $config);
