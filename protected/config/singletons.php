<?php
/** @noinspection ClassConstantCanBeUsedInspection */
return [
    yii\widgets\LinkPager::class => [
        'class' => app\widgets\LinkPager\LinkPager::class,
        'lastPageLabel' => true,
        'firstPageLabel' => true,
        'jumpPageLabel' => true,
    ],
    yii\bootstrap4\LinkPager::class => [
        'class' => app\widgets\LinkPager\LinkPager::class,
        'lastPageLabel' => true,
        'firstPageLabel' => true,
        'jumpPageLabel' => true,
    ],
    yii\widgets\ActiveField::class => [
        'class' => yii\bootstrap4\ActiveField::class,
    ],
    yii\widgets\ActiveForm::class => [
        'class' => yii\bootstrap4\ActiveForm::class,
    ],
    yii\widgets\InputWidget::class => [
        'class' => yii\bootstrap4\InputWidget::class,
    ],
    yii\grid\GridView::class => [
        'layout' => "{pager}\n{summary}\n{items}\n{pager}",
    ],
];
