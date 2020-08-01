<?php

namespace app\modules\articles\controllers;

use app\modules\articles\models\Articles;
use app\modules\articles\traits\IActiveArticlesStatus;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex(): string
    {
        $query = Articles::find()->where(['status' => IActiveArticlesStatus::ACTIVE]);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => $this->module->params['pageSize'],
            'validatePage' => false,
            'pageSizeLimit' => false,
        ]);

        if ($pagination->page >= $pagination->pageCount) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', ['data' => $data, 'pagination' => $pagination,]);
    }

    /**
     * @param string $meta_url
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($meta_url): string
    {
        $model = $this->findModel($meta_url);
        $model->updateCounters(['view_count' => 1]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param string $meta_url
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($meta_url): Articles
    {
        if (($model = Articles::findOne(['meta_url' => $meta_url, 'status' => IActiveArticlesStatus::ACTIVE])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
