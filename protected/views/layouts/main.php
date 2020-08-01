<?php

/* @var $this View */

/* @var $content string */

use app\assets\SiteBeginAsset;
use app\assets\SitesEndAsset;
use app\modules\account\models\User;
use app\modules\articles\components\ArticlesItems;
use app\modules\rbac\helpers\RBAC;
use app\widgets\Alert;
use app\widgets\Thumbnail\Thumbnail;
use app\widgets\TopLink\TopLink;
use kartik\icons\Icon;
use kv4nt\owlcarousel\OwlCarouselWidget;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\web\View;
use yii\widgets\Menu;

$asset = SiteBeginAsset::register($this);
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

<div class="container-fluid">
    <div class="preloader">
        <div class="clear-load preloader-load">
            <span></span>
        </div>
    </div>
</div>

<header id="navbar_home">
    <?php
    $fixed_top = true;

    NavBar::begin([
        'brandLabel' => Yii::$app->params['brandLabel'] . ' ' . Yii::$app->params['brandLabelText'],
        'brandUrl' => Yii::$app->homeUrl,
        'renderInnerContainer' => false,
        'options' => [
            'class' => 'navbar navbar-expand-sm navbar-dark bg-info' . ($fixed_top ? ' sticky-top' : ''),
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
        <button class="btn btn-outline-danger btn-sm" type="submit">$placeholder</button>
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
    <?php OwlCarouselWidget::begin([
        'container' => 'div',
        'containerOptions' => [
            'id' => 'carousel_home',
            'class' => 'owl-theme',
        ],
        'pluginOptions' => [
            'nav' => true,
            'dots' => true,
//            'center' => true,
            'autoplay' => true,
            'autoplayHoverPouse' => true,
            'smartSpeed' => 450,
            'items' => 1,
            'loop' => true,
            'animateOut' => 'zoomOutDown',
            'animateIn' => 'flipInX',
        ],
    ]);
    ?>

    <div class="item">
        <?= Html::img($asset->baseUrl . '/img/carousel1.png', ['alt' => 'Image 1']) ?>
        <div class="item-body">
            <h1>This is title 1</h1>
            <p>This is the caption text</p>
        </div>
    </div>
    <div class="item">
        <?= Html::img($asset->baseUrl . '/img/carousel2.png', ['alt' => 'Image 2']) ?>
        <div class="item-body">
            <h2>This is title 1</h2>
            <p>This is the caption text</p>
        </div>
    </div>
    <div class="item">
        <?= Html::img($asset->baseUrl . '/img/carousel3.png', ['alt' => 'Image 3']) ?>
        <div class="item-body">
            <h3>This is title 1</h3>
            <p>This is the caption text</p>
        </div>
    </div>

    <?php OwlCarouselWidget::end(); ?>

    <?php
    $menuItems = [];

    $menuItems[] = ['label' => Yii::t('app', 'About company'),
        'items' => [
            ['label' => Yii::t('app', 'Docs'),
                'url' => ['/statics/default/index', 'meta_url' => 'docs'],
            ],
            ['label' => Yii::t('app', 'History'),
                'url' => ['/statics/default/index', 'meta_url' => 'history'],
            ],
            ['label' => Yii::t('app', 'Priorities'),
                'url' => ['/statics/default/index', 'meta_url' => 'priorities'],
            ],
            ['label' => Yii::t('app', 'About'),
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
    ];

    $menuItems[] = ['label' => Yii::t('app', 'Partners'),
        'items' => [
            ['label' => Yii::t('app', 'Map'),
                'url' => ['/statics/default/index', 'meta_url' => 'euromap'],
            ],
            '<div class="dropdown-divider"></div>',
            ['label' => Yii::t('app', 'For partners'),
                'url' => ['/statics/default/index', 'meta_url' => 'partners'],
            ],
        ],
    ];

    $menuItems[] = ['label' => Yii::t('app', 'Career'),
        'items' => [
            ['label' => Yii::t('app', 'Vacancies'),
                'url' => ['/statics/default/index', 'meta_url' => 'vacancy'],
            ],
            ['label' => Yii::t('app', 'Working conditions'),
                'url' => ['/statics/default/index', 'meta_url' => 'conditions'],
            ],
            ['label' => Yii::t('app', 'Send resume'),
                'url' => ['/statics/default/index', 'meta_url' => 'resume'],
            ],
            ['label' => Yii::t('app', 'For students'),
                'url' => ['/statics/default/index', 'meta_url' => 'students'],
            ],
            ['label' => Yii::t('app', 'Part-timers'),
                'url' => ['/statics/default/index', 'meta_url' => 'part-timers'],
            ],
        ],
    ];

    $item = ArticlesItems::items(['published_at' => SORT_DESC, 'id' => SORT_ASC]);
    if ($item) {
        $menuItems[] = $item;
    }

    $menuItems[] = ['label' => Icon::show('envelope'),
        'encode' => false,
        'url' => ['/contact/default/index'],
        'options' => [
            'title' => Yii::t('app', 'Contact'),
        ],
    ];

    $menuItems[] = ['label' => Icon::show('phone-alt'),
        'encode' => false,
        'url' => ['/callback/default/index'],
        'options' => [
            'title' => Yii::t('app', 'Callback'),
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
                'aria' => ['haspopup' => 'true', 'expanded' => 'false',],
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

<footer class="container-fluid badge-dark border-top border-danger">
    <div class="row justify-content-between">
        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6" data-aos="fade-right">
            <h2>About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis impedit, odit minima repellat,
                doloribus alias amet consequatur inventore.</p>
        </div>

        <?php
        $items = ArticlesItems::items(['published_at' => SORT_ASC, 'view_count' => SORT_DESC]);
        if ($items): ?>
            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6" data-aos="fade-up">
                <h4><?= $items['label'] ?></h4>
                <?= Menu::widget([
                    'options' => ['class' => 'list-unstyled'],
                    'items' => $items['items'],
                ]) ?>
            </div>
        <?php endif ?>

        <?php
        $menuItems = [
            ['label' => Yii::t('app', 'About Us'),
                'url' => '#',
            ],
            ['label' => Yii::t('app', 'Testimonials'),
                'url' => '#',
            ],
            ['label' => Yii::t('app', 'Terms of Service'),
                'url' => '#',
            ],
            ['label' => Yii::t('app', 'Privacy'),
                'url' => '#',
            ],
            ['label' => Yii::t('app', 'Contact Us'),
                'url' => '#',
            ],
        ];
        ?>

        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6" data-aos="fade-up">
            <h4>Quick Links</h4>
            <?= Menu::widget([
                'options' => ['class' => 'list-unstyled'],
                'items' => $menuItems,
            ]) ?>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6" data-aos="fade-up">
            <h4 class="footer-heading">Quick Links</h4>
            <?= Menu::widget([
                'options' => ['class' => 'list-unstyled'],
                'items' => $menuItems,
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <span class="text-left">&copy <?= Yii::$app->params['brandLabel'] ?></span>
            <span class="text-right"><?= date('Y') ?></span>
        </div>
        <div class="col-auto ml-auto text-wrap small" style="width: 15rem;">
            <?= Yii::t('app', 'All rights, including related copyrights are reserved by the respective owners.') ?>
        </div>
    </div>
</footer>

<?= TopLink::widget() ?>
<?= Thumbnail::widget() ?>

<?php SitesEndAsset::register($this); ?>
<?php $this->endBody() ?>

<script>
    AOS.init();
</script>
</body>
</html>
<?php $this->endPage() ?>
