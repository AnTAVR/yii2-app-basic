<?php

/* @var $this View */

/* @var $models Category[] */

use app\helpers\CSS;
use app\modules\products\models\Category;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\Menu;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['/products']];

$this->title = Yii::t('app', 'Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $items = [];
    foreach ($models as $model) {
        /* @var $model Category */
        $items[] = [
            'label' => $model->content_title . ' (' . $model->count . ')',
            'url' => $model->url,
        ];
    }
    echo Menu::widget([
        'items' => $items,
    ])
    ?>

</div>
