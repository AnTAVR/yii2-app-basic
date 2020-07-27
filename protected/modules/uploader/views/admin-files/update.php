<?php

/* @var $this View */

/* @var $model UploaderFile */

use app\helpers\CSS;
use app\modules\uploader\models\UploaderFile;
use yii\bootstrap4\Html;
use yii\web\View;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Uploader Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];

$this->title = Yii::t('yii', 'Update');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
