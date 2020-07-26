<?php

/* @var $this View */

/* @var $model LoginForm */

use app\modules\account\models\LoginForm;
use app\widgets\Captcha;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>

<?= $form->field($model, 'verifyCode')->widget(Captcha::class) ?>

<div class="form-group">
    <div class="d-flex">
        <div class="btn-group p-2 ml-auto">
            <?= Html::submitButton(Yii::t('app', 'Login'),
                ['class' => 'btn btn-primary']
            ) ?>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
