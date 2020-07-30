<?php

/* @var $this View */

/* @var $model CallbackForm */

use app\modules\callback\models\CallbackForm;
use app\widgets\Captcha;
use borales\extensions\phoneInput\PhoneInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(['id' => 'callback-form']); ?>

<?= $form->field($model, 'phone')
    ->widget(PhoneInput::class, [
        'options' => ['autofocus' => true,],
        'jsOptions' => [
            'preferredCountries' => Yii::$app->params['phone.countries'],
        ]
    ]) ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'verifyCode')
    ->widget(Captcha::class) ?>

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
