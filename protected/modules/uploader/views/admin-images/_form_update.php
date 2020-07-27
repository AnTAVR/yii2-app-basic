<?php

/* @var $this View */

/* @var $model UploaderImage */

use app\modules\uploader\models\UploaderImage;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'file',
        'thumbnailUrl:image:',
        'thumbnailUrl:ntext',
        'url:ntext',
    ],
]) ?>

<?php $form = ActiveForm::begin(['id' => 'uploader-form']); ?>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <div class="d-flex">
        <div class="btn-group p-2 ml-auto">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary',]) ?>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
