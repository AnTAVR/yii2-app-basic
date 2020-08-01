<?php

/* @var $this View */

/* @var $model Articles */

use app\modules\articles\models\Articles;
use app\modules\articles\traits\ArticlesStatusTrait;
use app\widgets\UrlTranslit\UrlTranslit;
use kartik\datetime\DateTimePicker;
use kartik\editors\Summernote;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(['id' => 'articles-form']); ?>

<div class="form-group form-row">
    <?= $form->field($model, 'status', ['options' => ['class' => 'col-md-3']])
        ->dropDownList(ArticlesStatusTrait::getStatusList()) ?>

    <?= $form->field($model, 'published', ['options' => ['class' => 'col-md-5']])
        ->widget(DateTimePicker::class, [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii:ss',
                'todayBtn' => true,
                'autoclose' => true,
            ]
        ]) ?>

</div>

<?= $form->field($model, 'meta_url')
    ->widget(UrlTranslit::class, [
        'fromField' => 'content_title',
        'options' => ['maxlength' => true],
    ]) ?>

<?= $form->field($model, 'content_title')
    ->textInput(['maxlength' => true, 'autofocus' => true]) ?>

<?= $form->field($model, 'content_short')
    ->widget(Summernote::class, [
        'options' => ['rows' => 6],
    ]) ?>

<?= $form->field($model, 'content_full')
    ->widget(Summernote::class, [
        'options' => ['rows' => 6],
    ]) ?>

<?= $form->field($model, 'meta_description')
    ->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'meta_keywords')
    ->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <div class="btn-group p-2 ml-auto">
        <?= $model->isNewRecord ?
            Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success',]) :
            Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary',])
        ?>

    </div>
</div>

<?php ActiveForm::end(); ?>
