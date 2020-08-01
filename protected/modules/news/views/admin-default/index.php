<?php

/* @var $this View */

/* @var $dataProvider ActiveDataProvider */

/* @var $searchModel NewsSearch */

use app\components\grid\ActionColumn;
use app\helpers\CSS;
use app\modules\news\models\News;
use app\modules\news\models\NewsSearch;
use app\modules\news\traits\NewsStatusTrait;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

$this->title = Yii::t('app', 'News');
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
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'class' => 'col-1'
                ],
            ],
            [
                'attribute' => 'meta_url',
                'value' => static function ($data) {
                    /** @var News $data */
                    return $data->getUrl();
                }
            ],
            'content_title',
            'published_at:datetime',
            [
                'attribute' => 'status',
                'filter' => NewsStatusTrait::getStatusList(),
                'value' => static function ($data) {
                    /** @var News $data */
                    return $data->getStatus();
                }
            ],
            'view_count:integer',
            [
                'class' => ActionColumn::class,
                'template' => '{viewOnSite} {view} {update} {delete}',
            ],
        ],
    ]) ?>

</div>