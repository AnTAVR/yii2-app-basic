<?php

namespace app\modules\account\actions;

use app\modules\account\models\LoginForm;
use Yii;
use yii\base\Action;
use yii\web\Response;

class LoginAction extends Action
{
    public $view = '@app/modules/account/views/login';

    /**
     * @return Response|string
     */
    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->goBack();
        }

        $model->password = '';
        return $this->controller->render($this->view, [
            'model' => $model,
        ]);
    }
}
