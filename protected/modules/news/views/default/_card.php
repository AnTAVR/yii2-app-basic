<?php

/* @var $this View */
/* @var $model News */

/* @var $class string */

use app\helpers\CSS;
use app\modules\news\models\News;
use yii\bootstrap4\Html;
use yii\web\View;

?>

<div class="pt-2 pb-2 <?= $class ?> <?= CSS::generateCurrentClass() ?>" data-aos="fade-up">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title"><?= Html::encode($model->content_title) ?></h2>

            <?= $model->content_short ?>

            <?= Html::a(Yii::t('app', 'More') . ' &raquo',
                ['view', 'meta_url' => $model->meta_url],
                [
                    'class' => 'card-link',
                ]) ?>

        </div>
    </div>
</div>
