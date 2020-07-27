<?php

/* @var $this View */

/* @var $model UploaderFileForm */

use app\helpers\CSS;
use app\modules\uploader\models\UploaderFileForm;
use yii\helpers\Html;
use yii\web\View;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Uploader Files'), 'url' => ['index']];

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix <?= CSS::generateCurrentClass() ?>">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
    ]) ?>

</div>
