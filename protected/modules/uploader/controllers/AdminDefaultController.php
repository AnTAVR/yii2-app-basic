<?php

namespace app\modules\uploader\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class AdminDefaultController extends Controller
{
    public $layout = '@app/views/layouts/admin';

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['uploader.openAdminPanel'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
