<?php

namespace app\modules\account\actions;

use Yii;
use yii\base\Action;
use yii\web\Response;

class LogoutAction extends Action
{
    public function run(): Response
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        return $this->controller->goHome();
    }
}
