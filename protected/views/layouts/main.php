<?php

/* @var $this View */

/* @var $content string */

use app\assets\SiteAsset as Asset;
use app\modules\account\models\User;
use app\modules\rbac\helpers\RBAC;
use app\widgets\Alert;
use app\widgets\Thumbnail\Thumbnail;
use app\widgets\TopLink\TopLink;
use kartik\icons\Icon;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Carousel;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\web\View;

$asset = Asset::register($this);
$charset = Yii::$app->charset;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= $charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>
<header>
    <?php
    $fixed_top = true;

    NavBar::begin([
        'brandLabel' => Yii::$app->params['brandLabel'] . ' ' . Yii::$app->params['brandLabelText'],
        'brandUrl' => Yii::$app->homeUrl,
        'renderInnerContainer' => false,
        'options' => [
            'class' => 'navbar navbar-expand-sm navbar-dark bg-dark' . ($fixed_top ? ' sticky-top' : ''),
        ],
    ]);

    $placeholder = Yii::t('app', 'Search');
    $menuItems = [
        <<<HTML5
<li class="nav-item float-left">
    <form class="form-inline" action="https://www.google.ru/cse" target="_blank">
        <input type="hidden" name="cx" value="">
        <input type="hidden" name="ie" value="$charset">
        <input class="form-control-sm m-1" type="search" name="q" placeholder="$placeholder" aria-label="$placeholder">
        <button class="btn btn-outline-success btn-sm" type="submit">$placeholder</button>
    </form>
</li>
HTML5,
    ];

    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav ml-auto mr-0',
        ],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main class="container-fluid">
    <?= Carousel::widget([
        'showIndicators' => true,
        'crossfade' => true,
//        'controls' => [
//            Icon::show('chevron-left', ['aria-hidden' => 'true']),
//            Icon::show('chevron-right', ['aria-hidden' => 'true']),
//            '',
//            '',
//        ],
        'items' => [
            [
                'content' => Html::img($asset->baseUrl . '/img/carousel1.png', ['class' => 'carousel-img']),
                'caption' => '<h1>This is title 1</h1><p>This is the caption text</p>',
            ],
            [
                'content' => Html::img($asset->baseUrl . '/img/carousel2.png', ['class' => 'carousel-img']),
                'caption' => '<h2>This is title 2</h2><p>This is the caption text</p>',
            ],
            [
                'content' => Html::img($asset->baseUrl . '/img/carousel3.png', ['class' => 'carousel-img']),
                'caption' => '<h3>This is title 3</h3><p>This is the caption text</p>',
            ],
        ]
    ]) ?>

    <?php
    $menuItems = [
        ['label' => Yii::t('app', 'О компании'),
            'items' => [
                ['label' => Yii::t('app', 'Docs'), 'url' => ['/statics/default/index', 'meta_url' => 'docs']],
                ['label' => Yii::t('app', 'История'), 'url' => ['/statics/default/index', 'meta_url' => 'history']],
                ['label' => Yii::t('app', 'Приоритеты'), 'url' => ['/statics/default/index', 'meta_url' => 'priorities']],
                ['label' => Yii::t('app', 'About'),
                    'encode' => false,
                    'url' => ['/statics/default/index', 'meta_url' => 'about'],
                ],
                ['label' => Yii::t('app', 'Delivery'),
                    'encode' => false,
                    'url' => ['/statics/default/index', 'meta_url' => 'delivery'],
                ],
                ['label' => Yii::t('app', 'Payment'),
                    'encode' => false,
                    'url' => ['/statics/default/index', 'meta_url' => 'payment'],
                ],
                '<div class="dropdown-divider"></div>',
                ['label' => Yii::t('app', 'Rules'),
                    'encode' => false,
                    'url' => ['/statics/default/index', 'meta_url' => 'rules'],
                ],
            ],
        ],
        ['label' => Yii::t('app', 'Партнеры'),
            'items' => [
                ['label' => Yii::t('app', 'Карта Евразии'), 'url' => ['/statics/default/index', 'meta_url' => 'euromap']],
                '<div class="dropdown-divider"></div>',
                ['label' => Yii::t('app', 'Партнерам'), 'url' => ['/statics/default/index', 'meta_url' => 'partners']],
            ],
        ],
        ['label' => Yii::t('app', 'Карьера'),
            'items' => [
                ['label' => Yii::t('app', 'Вакансии'), 'url' => ['/statics/default/index', 'meta_url' => 'vacancy']],
                ['label' => Yii::t('app', 'Условия работы'), 'url' => ['/statics/default/index', 'meta_url' => 'conditions']],
                ['label' => Yii::t('app', 'Выслать резюме'), 'url' => ['/statics/default/index', 'meta_url' => 'resume']],
                ['label' => Yii::t('app', 'Для студентов'), 'url' => ['/statics/default/index', 'meta_url' => 'students']],
                ['label' => Yii::t('app', 'Совместителем'), 'url' => ['/statics/default/index', 'meta_url' => 'part-timers']],
            ],
        ],
        ['label' => Icon::show('envelope'),
            'encode' => false,
            'url' => ['/contact/default/index'],
            'options' => [
                'title' => Yii::t('app', 'Contact'),
            ],
        ],
    ];

    $profileItems = [];

    if (Yii::$app->user->isGuest) {
        $profileItems = ['label' => Icon::show('sign-in-alt'),
            'encode' => false,
            'url' => Yii::$app->user->loginUrl,
            'options' => [
                'title' => Yii::t('app', 'Login'),
                'class' => 'dropleft ml-auto',
            ],
        ];
    } else {
        $items = [
            ['label' => Icon::show('user-cog') . Yii::t('app', 'Profile'),
                'encode' => false,
                'url' => ['/account/default/index'],
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => Icon::show('sign-out-alt') . Yii::t('app', 'Logout'),
                'encode' => false,
                'url' => ['/site/logout'],
                'linkOptions' => [
                    'data' => ['method' => 'post'],
                ],
            ],
        ];
        if (Yii::$app->user->can(RBAC::ADMIN_PERMISSION)) {
            $AdminPanelItem = ['label' => Icon::show('tools') . Yii::t('app', 'Admin panel'),
                'encode' => false,
                'url' => ['/admin-site/index'],
                'linkOptions' => [
                    'target' => '_blank',
                ],
            ];
            array_unshift($items, '<div class="dropdown-divider"></div>');
            array_unshift($items, $AdminPanelItem);
        }

        /** @var $identity User */
//        $identity = Yii::$app->user->identity;
        $profileItems = ['label' => Icon::show('user'),
            'encode' => false,
            'items' => $items,
            'options' => [
                'class' => 'dropleft ml-auto',
            ],
            'linkOptions' => [
                'aria' => ['haspopup' => "true", 'expanded' => "false",],
            ],
        ];
    }

    //if (!Yii::$app->user->isGuest) {
    $menuItems[] = $profileItems;
    //}

    echo Nav::widget([
        'options' => ['class' => 'nav nav-pills d-flex'],
        'items' => $menuItems,
    ]);
    ?>

    <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'] ?? [],
    ]) ?>

    <?= Alert::widget() ?>

    <?= $content ?>

</main>

<footer class="container-fluid mt-auto clearfix footer">
    <p class="float-left">
        <span class="text-left">&copy <?= Yii::$app->params['brandLabel'] ?></span>
        <span class="text-right"><?= date('Y') ?></span>
    </p>

    <p class="float-right text-wrap small" style="width: 15rem;">
        <?= Yii::t('app', 'All rights, including related copyrights are reserved by the respective owners.') ?>
    </p>
</footer>

<?= TopLink::widget() ?>
<?= Thumbnail::widget() ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
