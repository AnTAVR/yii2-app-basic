<?php

/* @var $this View */

use app\helpers\CSS;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

</div>
