<?php

namespace app\controllers;

use app\modules\rbac\helpers\RBAC;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminSiteController extends Controller
{
    public $layout = '@app/views/layouts/admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [RBAC::ADMIN_PERMISSION],
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
        return $this->render('index');
    }
}
