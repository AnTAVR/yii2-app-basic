<?php

/* @var $this View */

/* @var $content string */

use app\assets\AdminBeginAsset;
use app\assets\AdminEndAsset;
use app\widgets\Alert;
use app\widgets\Thumbnail\Thumbnail;
use app\widgets\TopLink\TopLink;
use kartik\icons\Icon;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\web\View;

$asset = AdminBeginAsset::register($this);
$charset = Yii::$app->charset;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= $charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<header>
    <?php
    $fixed_top = false;

    NavBar::begin([
        'brandLabel' => Icon::show('tools') . Yii::t('app', 'Admin panel'),
        'brandUrl' => ['/admin-site'],
        'renderInnerContainer' => false,
        'options' => [
            'class' => 'navbar navbar-expand-sm navbar-dark bg-dark' . ($fixed_top ? ' sticky-top' : ''),
        ],
    ]);

    $menuItems = [
        ['label' => Icon::show('home') . Yii::t('app', 'On site'),
            'encode' => false,
            'url' => Yii::$app->homeUrl,
            'linkOptions' => [
                'target' => '_blank',
            ],
            'options' => [
                'title' => Yii::t('app', 'View on site'),
            ],
        ],
        ['label' => Icon::show('sign-out-alt') . Yii::t('app', 'Logout'),
            'encode' => false,
            'url' => ['/site/logout'],
            'linkOptions' => [
                'data' => ['method' => 'post'],
            ],
            'options' => [
                'title' => Yii::t('app', 'Logout'),
            ],
        ],
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
    <div class="row pt-2">
        <div class="col-12 col-md-auto">
            <?= $this->render('admin_menu') ?>
        </div>

        <div class="col-12 col-md">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => Yii::t('app', 'Admin panel'),
                    'url' => ['/admin-site'],
                ],
                'links' => $this->params['breadcrumbs'] ?? [],
            ]) ?>

            <?= Alert::widget() ?>

            <?= $content ?>

        </div>
    </div>
</main>

<footer class="container-fluid badge-dark border-top border-danger">
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

<?php AdminEndAsset::register($this); ?>
<?php $this->endBody() ?>

<script>
    AOS.init();
</script>
</body>
</html>
<?php $this->endPage() ?>
