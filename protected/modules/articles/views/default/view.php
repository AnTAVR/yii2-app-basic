<?php

/* @var $this View */

/* @var $model Articles */

use app\helpers\CSS;
use app\modules\articles\models\Articles;
use yii\web\View;

if (!empty($model->meta_description)) {
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $model->meta_description]);
}
if (!empty($model->meta_keywords)) {
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $model->meta_keywords]);
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['/articles']];

$this->title = $model->content_title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <?= $model->content_full ?>

</div>
