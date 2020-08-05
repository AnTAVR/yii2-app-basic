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
    'options' => ['class' => 'd-none d-xl-block'],
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
        ['label' => Yii::t('app', 'Articles'),
            'active' => $moduleId === 'articles',
            'visible' => $user->can('articles.openAdminPanel'),
            'url' => ['/articles/admin-default'],
        ],
        ['label' => Yii::t('app', 'News'),
            'active' => $moduleId === 'news',
            'visible' => $user->can('news.openAdminPanel'),
            'url' => ['/news/admin-default'],
        ],
        ['label' => Yii::t('app', 'Products'),
            'active' => $moduleId === 'products',
            'visible' => $user->can('products.openAdminPanel'),
            'url' => ['/products/admin-default'],
            'items' => [
                ['label' => Yii::t('app', 'Category'),
                    'active' => $moduleId === 'products' && $controllerId === 'admin-category',
                    'url' => ['/products/admin-category'],
                ],
                ['label' => Yii::t('app', 'Products'),
                    'active' => $moduleId === 'products' && $controllerId === 'admin-product',
                    'url' => ['/products/admin-product'],
                ],
            ],
        ],
    ],
]) ?>
