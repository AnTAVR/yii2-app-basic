<?php

/* @var $this View */

/* @var $model CallbackForm */

use app\helpers\CSS;
use app\modules\callback\models\CallbackForm;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Callback');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix d-flex justify-content-center <?= CSS::generateCurrentClass() ?>">
    <div>
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Yii::t('app', 'Please fill in the following form and we will call you back.') ?>
            <br>
            <?= Yii::t('app', 'Thank you.') ?>
        </p>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
