<?php

namespace app\modules\statics\controllers;

use app\modules\statics\models\StaticPage;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{

    /**
     * @param string $meta_url
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($meta_url = null): string
    {
        return $this->render('index', [
            'model' => self::findModel($meta_url),
        ]);
    }

    /**
     * @param string $meta_url
     * @return StaticPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($meta_url): StaticPage
    {
        if (($model = StaticPage::findOne(['meta_url' => $meta_url])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
