<?php

/* @var $this View */

/* @var $model UploaderFile */

use app\modules\uploader\models\UploaderFile;
use yii\web\View;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'meta_url',
        'url',
        'file',
        'comment:ntext',
    ],
]) ?>
