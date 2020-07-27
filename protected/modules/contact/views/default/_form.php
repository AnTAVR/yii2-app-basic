<?php

/* @var $this View */

/* @var $model ContactForm */

use app\modules\contact\models\ContactForm;
use app\widgets\Captcha;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'subject') ?>

<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'verifyCode')->widget(Captcha::class) ?>

<div class="form-group">
    <div class="d-flex">
        <div class="btn-group p-2 ml-auto">
            <?= Html::submitButton(Yii::t('app', 'Send'),
                ['class' => 'btn btn-primary']
            ) ?>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
