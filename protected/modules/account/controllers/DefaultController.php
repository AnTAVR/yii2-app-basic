<?php

namespace app\modules\account\controllers;

use app\modules\account\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $user = User::findIdentity(Yii::$app->user->id);

        return $this->render('index', [
            'user' => $user,
        ]);
    }
}
