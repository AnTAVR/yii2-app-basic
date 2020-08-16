<?php

/* @var $this View */

/* @var $model Products */

use app\modules\products\models\Category;
use app\modules\products\models\Products;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'meta_url',
        'url',
        'view_count',
        'content_title',
        'content_short:raw',
        'content_full:raw',
        'published_at:datetime',
        [
            'attribute' => 'status',
            'value' => $model->getStatus(),
        ],
        'meta_description',
        'meta_keywords',
        [
            'attribute' => 'categories',
            'value' => static function ($model) {
                /** @var Products $model */
                $ret = [];
                foreach ($model->categories as $model_) {
                    /** @var Category $model_ */
                    $ret[] = Html::a($model_->content_title, $model_->url, ['target' => 'blank']);
                }
                return implode('<br />', $ret);
            },
            'format' => 'raw',
        ]
    ],
]) ?>
