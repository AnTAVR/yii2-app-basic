<?php

/* @var $this View */

/* @var $model Articles */

use app\helpers\CSS;
use app\modules\articles\models\Articles;
use yii\bootstrap4\Html;
use yii\web\View;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
