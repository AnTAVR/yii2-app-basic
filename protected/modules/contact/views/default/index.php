<?php

/* @var $this View */

/* @var $model ContactForm */

use app\helpers\CSS;
use app\modules\contact\models\ContactForm;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix d-flex justify-content-center <?= CSS::generateCurrentClass() ?>">
    <div>
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Yii::t('app', 'If you have business inquiries or other questions, please fill out the following form to contact us.') ?>
            <br>
            <?= Yii::t('app', 'Thank you.') ?>
        </p>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
