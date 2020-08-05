<?php

/* @var $this View */
/* @var $data Products[] */
/* @var $pagination Pagination */

/* @var $model Category */

use app\helpers\CSS;
use app\modules\products\models\Category;
use app\modules\products\models\Products;
use app\widgets\LinkPager\LinkPager;
use yii\bootstrap4\Html;
use yii\data\Pagination;
use yii\web\View;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['/products']];

$this->title = $model->content_title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <?php
    if ($model->content_full) {
        echo Html::tag('div', $model->content_full, ['class' => 'clearfix card-body',]);
    }
    ?>

    <?= LinkPager::widget(['pagination' => $pagination,]) ?>

    <?php
    $col = 1;
    $i = 0;
    foreach ($data as $model_) {
        /* @var $model Products */
        if (!$i) {
            echo '<div class="row">', "\n";
            $open = true;
        }
        echo $this->render('_card', ['model' => $model_, 'class' => 'col-sm-6']);
        if ($i >= $col) {
            echo '</div>', "\n\n";
            $i = 0;
        } else {
            $i++;
        }
    }
    if ($i) {
        echo '</div>', "\n\n";
    }
    ?>

    <?= LinkPager::widget(['pagination' => $pagination,]) ?>

</div>
