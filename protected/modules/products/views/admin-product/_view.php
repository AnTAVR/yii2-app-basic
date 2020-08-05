<?php

/* @var $this View */

/* @var $model Products */

use app\modules\products\models\Products;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'meta_url',
        'url',
        'view_count',
        [
            'attribute' => 'category_id',
            'value' => ArrayHelper::getValue($model, 'category.content_title'),
        ],
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
    ],
]) ?>
