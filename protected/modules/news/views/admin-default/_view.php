<?php

/* @var $this View */

/* @var $model News */

use app\modules\news\models\News;
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
    ],
]) ?>
