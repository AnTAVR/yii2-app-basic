<?php

/* @var $this View */

/* @var $model StaticPage */

use app\modules\statics\models\StaticPage;
use app\widgets\UrlTranslit\UrlTranslit;
use kartik\editors\Summernote;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(['id' => 'statics-form']); ?>

<?= $form->field($model, 'meta_url')->widget(UrlTranslit::class, [
    'fromField' => 'content_title',
    'options' => ['maxlength' => true],
]) ?>

<?= $form->field($model, 'content_title')->textInput(['maxlength' => true, 'autofocus' => true,]) ?>

<?= $form->field($model, 'content_full')->widget(Summernote::class, [
    'options' => ['rows' => 6],
]) ?>

<?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <div class="d-flex">
        <div class="btn-group p-2 ml-auto">
            <?= $model->isNewRecord ?
                Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success',]) :
                Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary',])
            ?>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
