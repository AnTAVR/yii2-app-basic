<?php

/* @var $this View */

/* @var $dataProvider ArrayDataProvider */

use app\components\grid\ActionColumn;
use app\helpers\CSS;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\data\ArrayDataProvider;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\web\View;

$this->title = Yii::t('app', 'Dump DB');
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
                    'data-method' => 'post',
                ]
            ) ?>
            <?= Html::a(
                Icon::show('trash') . Yii::t('app', 'Delete all'),
                ['delete-all'],
                [
                    'class' => 'btn btn-outline-danger',
                    'data-method' => 'post',
                    'data-confirm' => Yii::t('app', 'Delete all?'),
                ]
            ) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => SerialColumn::class,
                'headerOptions' => [
                    'class' => 'col-1'
                ],
            ],
            [
                'class' => DataColumn::class,
                'attribute' => 'file',
                'label' => Yii::t('app', 'File'),
            ],
            [
                'class' => DataColumn::class,
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => Yii::t('app', 'Created At'),
            ],
            [
                'class' => ActionColumn::class,
//                'header' => Yii::t('app', 'Actions'),
                'template' => '{download} {restore} {delete}',
            ],
        ],
    ]) ?>

</div>
