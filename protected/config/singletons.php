<?php

use yii\grid\GridView;
use yii\widgets\LinkPager;

return [
    LinkPager::class => [
        'class' => \app\widgets\LinkPager\LinkPager::class,
        'lastPageLabel' => true,
        'firstPageLabel' => true,
        'jumpPageLabel' => true,
    ],
    yii\bootstrap4\LinkPager::class => [
        'class' => \app\widgets\LinkPager\LinkPager::class,
        'lastPageLabel' => true,
        'firstPageLabel' => true,
        'jumpPageLabel' => true,
    ],
    GridView::class => [
        'layout' => "{pager}\n{summary}\n{items}\n{pager}",
    ],
];
