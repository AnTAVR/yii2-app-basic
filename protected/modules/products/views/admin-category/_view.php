<?php

/* @var $this View */

/* @var $model Category */

use app\modules\products\models\Category;
use yii\web\View;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'meta_url',
        'url',
        'count',
        'content_title',
        'content_full:raw',
        'published_at:datetime',
        [
            'attribute' => 'type',
            'value' => $model->getType(),
        ],
        'meta_description',
        'meta_keywords',
//        [
//            'attribute' => 'products',
//            'value' => static function ($model) {
//                /** @var Category $model */
//                $ret = [];
//                foreach ($model->products as $model_) {
//                    /** @var Products $model_ */
//                    $ret[] = Html::a($model_->content_title, $model_->url, ['target' => 'blank']);
//                }
//                return implode('<br />', $ret);
//            },
//            'format' => 'raw',
//        ]
    ],
]) ?>
