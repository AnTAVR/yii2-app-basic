<?php

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */

/* @var $searchModel ProductSearch */

use app\components\grid\ActionColumn;
use app\helpers\CSS;
use app\modules\products\models\Category;
use app\modules\products\models\Products;
use app\modules\products\models\ProductSearch;
use app\modules\products\traits\ProductsStatusTrait;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\CheckboxColumn;
use yii\grid\GridView;
use yii\web\View;

$this->title = Yii::t('app', 'Product');
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
                    'onclick' => <<< JAVASCRYPT
let grid = $("#grid").yiiGridView("getSelectedRows");
$(this).attr("data-params", JSON.stringify({grid}));
JAVASCRYPT,
                    'data-method' => 'post',
                    'data-confirm' => Yii::t('app', 'Delete selected?'),
                ]
            ) ?>

        </div>
    </div>

    <?= GridView::widget([
        'id' => 'grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::class,
            ],
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'class' => 'col-1'
                ],
            ],
            [
                'attribute' => 'meta_url',
                'value' => static function ($data) {
                    /** @var Products $data */
                    return $data->getUrl();
                }
            ],
            'content_title',
            'published_at:datetime',
            [
                'attribute' => 'status',
                'filter' => ProductsStatusTrait::getStatusList(),
                'value' => static function ($data) {
                    /** @var Products $data */
                    return $data->getStatus();
                }
            ],
            [
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['content_title', 'id'])->indexBy('id')->column(),
                'value' => 'category.content_title',
            ],
            'view_count:integer',
            [
                'class' => ActionColumn::class,
                'template' => '{viewOnSite} {view} {update} {delete}',
            ],
        ],
    ]) ?>

</div>
