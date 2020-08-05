<?php

namespace app\modules\products\controllers;

use app\modules\products\models\Category;
use app\modules\products\models\Products;
use app\modules\products\traits\IActiveProductsStatus;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex(): string
    {
        $models = Category::find()->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    /**
     * @param string $meta_url
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($meta_url): string
    {
        $model = $this->findModel($meta_url);
        $query = Products::find()->where(['status' => IActiveProductsStatus::ACTIVE, 'category_id' => $model->id]);

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

        return $this->render('view', ['data' => $data, 'pagination' => $pagination, 'model' => $model]);
    }

    /**
     * @param string $meta_url
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($meta_url): Category
    {
        if (($model = Category::findOne(['meta_url' => $meta_url])) === null) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        return $model;
    }
}
