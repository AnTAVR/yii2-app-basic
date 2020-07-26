<?php

/* @var $this View */

use yii\bootstrap4\Nav;
use yii\web\View;

$controllerId = Yii::$app->controller->id;
$moduleId = Yii::$app->controller->module->id;
$user = Yii::$app->user;
$route = Yii::$app->controller->getRoute();

?>
<?= Nav::widget([
    'options' => ['class' => 'nav nav-pills flex-column small'],
    'items' => [
        ['label' => Yii::t('app', 'Static Pages'),
            'visible' => $user->can('statics.openAdminPanel'),
            'active' => $moduleId === 'statics',
            'url' => ['/statics/admin-default/index'],
        ],
    ],
]) ?>
