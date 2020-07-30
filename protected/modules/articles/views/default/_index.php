<?php

/* @var $this View */
/* @var $model Articles */

/* @var $class string */

use app\modules\articles\models\Articles;
use yii\bootstrap4\Html;
use yii\web\View;

?>

<div class="<?= $class ?>" data-aos="fade-up">
    <div class="card mt-2 mb-2">
        <h4 class="card-header"><?= Html::encode($model->content_title) ?></h4>
        <div class="card-body">
            <?= $model->content_short ?>

        </div>
        <div class="card-footer">
            <?= Html::a(Yii::t('app', 'More') . ' &raquo',
                ['view', 'meta_url' => $model->meta_url],
                [
                    'class' => 'btn btn-light',
                ]) ?>

        </div>
    </div>
</div>
