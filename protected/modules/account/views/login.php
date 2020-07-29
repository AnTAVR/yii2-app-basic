<?php

/* @var $this View */

/* @var $model LoginForm */

use app\helpers\CSS;
use app\modules\account\models\LoginForm;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix d-flex justify-content-center <?= CSS::generateCurrentClass() ?>">
    <div>
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>

        <?= $this->render('_form', [
            'model' => $model,/**/
        ]) ?>

        <div class="col-lg" style="color:#999;">
            <?= Yii::t('app', 'You may login with {admin} or {tests}', ['admin' => '<strong>admin/adminadmin</strong>', 'tests' => '<strong>tests/teststests</strong>']) ?>
        </div>
    </div>
</div>
