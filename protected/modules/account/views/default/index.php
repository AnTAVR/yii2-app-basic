<?php

use app\modules\account\models\User;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/** @var $user User */

$this->title = Yii::t('app', 'Profile');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header">
        <h4><?= Yii::t('app', 'Profile') ?></h4>
    </div>
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $user,
            'attributes' => [
                'id',
                'username',
                'email:email',
                'email_confirmed:boolean',
                [
                    'attribute' => 'status',
                    'value' => $user->getStatus(),
                    'format' => 'raw',
                ],
                'created_at:datetime',
                [
                    'attribute' => 'created_ip',
                    'value' => Html::a($user->created_ip, 'http://ipinfo.io/' . $user->created_ip, ['target' => '_blank']),
                    'format' => 'raw',
                ],
                'updated_at:datetime',
                [
                    'attribute' => 'updated_ip',
                    'value' => Html::a($user->created_ip, 'http://ipinfo.io/' . $user->created_ip, ['target' => '_blank']),
                    'format' => 'raw',
                ],
            ],
        ]) ?>

    </div>
</div>
