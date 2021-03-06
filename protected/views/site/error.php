<?php

/* @var $this View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use app\helpers\CSS;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = $name;
?>

<div class="clearfix container <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>

    </div>

    <p>
        <?= Yii::t('app', 'The above error occurred while the Web server was processing your request.') ?>
    </p>
    <p>
        <?= Yii::t('app', 'Please contact us if you think this is a server error.') ?>
        <?= Yii::t('app', 'Thank you.') ?><br>
        <?= Html::a(Yii::t('app', 'Back to Home'), Yii::$app->homeUrl) ?><br>
    </p>
</div>
