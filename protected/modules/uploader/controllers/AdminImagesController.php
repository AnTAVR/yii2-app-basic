<?php

namespace app\modules\uploader\controllers;

use app\modules\uploader\models\UploaderImage;
use app\modules\uploader\models\UploaderImageForm;
use Exception;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AdminImagesController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'upload' => ['post'],
                    'multi-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UploaderImage::find(),
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param integer $id
     * @return UploaderImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): UploaderImage
    {
        if (($model = UploaderImage::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param integer $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate(): string
    {
        $model = new UploaderImageForm();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpload(): string
    {
        $model = new UploaderImageForm();

        if (!$model->load(Yii::$app->request->post())) {
            return Json::encode($model->errors);
        }

        return $model->upload();
    }

    /**
     * @param integer $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws Exception
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id): Response
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionMultiDelete(): Response
    {
        if ($grid = Yii::$app->request->post('grid')) {
            UploaderImage::deleteAll(['id' => explode(',', $grid)]);
        }
        return $this->redirect(['index']);
    }
}
