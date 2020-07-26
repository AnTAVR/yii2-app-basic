<?php

/* @var $this View */

/* @var $model StaticPage */

use app\helpers\CSS;
use app\modules\statics\models\StaticPage;
use yii\bootstrap4\Html;
use yii\web\View;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Static Pages'), 'url' => ['/statics/admin-default']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];

$this->title = Yii::t('yii', 'View');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex">
        <div class="btn-group p-2 ml-auto">
            <?= Html::a(Yii::t('yii', 'Update'),
                ['update', 'id' => $model->id],
                [
                    'class' => 'btn btn-outline-primary',
                ]) ?>
            <?= Html::a(Yii::t('yii', 'Delete'),
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-outline-danger',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>

        </div>
    </div>
    <?= $this->render('_view', [
        'model' => $model,
    ]) ?>

</div>
