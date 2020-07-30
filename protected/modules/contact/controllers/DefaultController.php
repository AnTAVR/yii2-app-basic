<?php

namespace app\modules\contact\controllers;

use app\modules\contact\models\ContactForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->addFlash('success',
                    Yii::t('app', 'Thank you for contacting us.')
                    . ' ' . Yii::t('app', 'We will respond to you as soon as possible.')
                );
                return $this->refresh();
            }

            Yii::$app->session->addFlash('error',
                Yii::t('app', 'There was an error sending email.')
            );
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
