<?php

/* @var $this View */

/* @var $model News */

use app\helpers\CSS;
use app\modules\news\models\News;
use yii\bootstrap4\Html;
use yii\web\View;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
