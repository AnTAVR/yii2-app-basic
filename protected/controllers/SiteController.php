<?php

namespace app\controllers;

use app\modules\account\actions\LoginAction;
use app\modules\account\actions\LogoutAction;
use app\modules\statics\controllers\DefaultController;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
                'layout' => 'error'
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => (YII_ENV_TEST || YII_ENV_DEV) ? 'testme' : null,
            ],
            'login' => [
                'class' => LoginAction::class,
            ],
            'logout' => [
                'class' => LogoutAction::class,
            ],
        ];
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex(): string
    {
        return $this->render('index', [
            'model' => DefaultController::findModel('index'),
        ]);
    }
}
