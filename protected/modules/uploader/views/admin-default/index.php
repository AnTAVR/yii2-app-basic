<?php

/* @var $this View */

/* @var $dataProvider ActiveDataProvider */

use app\helpers\CSS;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\web\View;

$this->title = Yii::t('app', 'Uploader');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

</div>