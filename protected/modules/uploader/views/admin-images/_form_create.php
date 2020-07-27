<?php

/* @var $this View */

/* @var $model UploaderImageForm */

use app\modules\uploader\models\UploaderImageForm;
use kartik\file\FileInput;
use kartik\icons\Icon;
use yii\bootstrap4\ActiveForm;
use yii\web\JsExpression;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(['id' => 'uploader-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'fileUpload')->widget(FileInput::class, [
    'options' => ['accept' => $model::ACCEPT, 'multiple' => true],
    'pluginOptions' => [
        'uploadExtraData' => new JsExpression(<<<JS
// noinspection JSUnusedLocalSymbols,ReservedWordAsName
function(previewId, index) {
    const fields = $('#$form->id').serializeArray();
    let data = {};
// noinspection JSUnusedLocalSymbols
    fields.forEach(function(v, i) {
        data[v.name] = v.value;
    });
    return data;
}
JS
        ),
        'required' => true,
        'uploadUrl' => ['upload'],
        'allowedFileExtensions' => explode(',', str_replace(' ', '', $model::EXTENSIONS)),
        'maxFileSize' => intdiv($model::MAX_SIZE, 1024),
        'browseClass' => 'btn btn-primary',
        'browseIcon' => Icon::show('camera'),
        'browseLabel' => Yii::t('app', 'Select Photo'),
    ],
]) ?>

<?php ActiveForm::end(); ?>
