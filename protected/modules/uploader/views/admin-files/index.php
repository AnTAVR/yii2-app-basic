<?php

/* @var $this View */

/* @var $dataProvider ActiveDataProvider */

use app\components\grid\ActionColumn;
use app\helpers\CSS;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\CheckboxColumn;
use yii\grid\GridView;
use yii\web\View;

$this->title = Yii::t('app', 'Uploader Files');
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
            <?= Html::a(
                Icon::show('trash') . Yii::t('app', 'Delete selected'),
                ['multi-delete'],
                [
                    'class' => 'btn btn-outline-danger',
                    'onclick' => <<<JS
let grid = $("#grid").yiiGridView("getSelectedRows");
$(this).attr("data-params", JSON.stringify({grid}));
JS,
                    'data-method' => 'post',
                    'data-confirm' => Yii::t('app', 'Delete selected?'),
                ]
            ) ?>

        </div>
    </div>

    <?= GridView::widget([
        'id' => 'grid',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => CheckboxColumn::class,
            ],
            'id',
            'url',
            'file',
            'comment:ntext',
            [
                'class' => ActionColumn::class,
//                'header' => Yii::t('app', 'Actions'),
                'template' => '{viewOnSite} {view} {update} {delete}',
            ],
        ],
    ]) ?>

</div>
