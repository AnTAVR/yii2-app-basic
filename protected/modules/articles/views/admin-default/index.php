<?php

/* @var $this View */

/* @var $dataProvider ActiveDataProvider */

use app\components\grid\ActionColumn;
use app\helpers\CSS;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\web\View;

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex">
        <div class="btn-group p-2 ml-auto">
            <?= Html::a(
                Icon::show('plus') . Yii::t('app', 'Create'),
                ['create'],
                [
                    'class' => 'btn btn-outline-success',
                ]
            ) ?>

        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => DataColumn::class,
                'attribute' => 'id',
                'headerOptions' => [
                    'class' => 'col-1'
                ],
            ],
            'url',
            'content_title',
            'published_at:datetime',
            'status_txt',
            [
                'class' => ActionColumn::class,
                'template' => '{viewOnSite} {view} {update} {delete}',
            ],
        ],
    ]) ?>

</div>