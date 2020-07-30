<?php

/* @var $this View */

use yii\web\View;
use yii\widgets\Menu;

$controllerId = Yii::$app->controller->id;
$moduleId = Yii::$app->controller->module->id;
$user = Yii::$app->user;
$route = Yii::$app->controller->getRoute();

?>
<?= Menu::widget([
    'options' => ['class' => 'list-unstyled small'],
    'items' => [
        ['label' => Yii::t('app', 'Dump DB'),
            'active' => $moduleId === 'dump',
            'visible' => $user->can('dump.openAdminPanel'),
            'url' => ['/dump/admin-default/index']],
        ['label' => Yii::t('app', 'Static Pages'),
            'visible' => $user->can('statics.openAdminPanel'),
            'active' => $moduleId === 'statics',
            'url' => ['/statics/admin-default/index'],
        ],
        ['label' => Yii::t('app', 'Uploader'),
            'active' => $moduleId === 'uploader',
            'visible' => $user->can('uploader.openAdminPanel'),
            'url' => ['/uploader/admin-default'],
            'items' => [
                ['label' => Yii::t('app', 'Uploader Images'),
                    'active' => $moduleId === 'uploader' && $controllerId === 'admin-images',
                    'url' => ['/uploader/admin-images'],
                ],
                ['label' => Yii::t('app', 'Uploader Files'),
                    'active' => $moduleId === 'uploader' && $controllerId === 'admin-files',
                    'url' => ['/uploader/admin-files'],
                ],
            ],
        ],
    ],
]) ?>
