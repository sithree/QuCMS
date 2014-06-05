<?php

namespace siasoft\qucms\controllers;

use Yii;
use siasoft\qucms\models\ImageInfo;
use siasoft\qucms\models\search\ImageInfo as ImageInfoSearch;
use siasoft\qucms\web\Controller;
use \yii\helpers\Json;
use \yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use siasoft\qucms\web\UploadHandler;

/**
 * ImageController implements the CRUD actions for ImageInfo model.
 */
class ImageController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    /**
     * Lists all ImageInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageInfoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single ImageInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ImageInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImageInfo;
        if ($model->load(Yii::$app->request->post())) {
            try {
                $image = \siasoft\qucms\web\Image::Upload($model);
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (Exception $ex) {
                
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionUpload()
    {
        return $this->render(false, [
                    'model' => new \siasoft\qucms\models\FakeImageModel()
        ]);
    }

    public function actionUploadImage()
    {
        //$images = Json::decode(Yii::$app->request->cookies->getValue('images', '[]'));
        $imageUploader = new UploadHandler([
            'image_versions' => [],
            'upload_dir' => Yii::$app->basePath . '/web/img/upload/',
            'upload_url' => '/img/upload/'
                ], false);
        $image = $imageUploader->post(false);
        //$images = array_merge($images, $image['files']);
        //Yii::$app->response->add(new Cookie(['name' => 'images', 'path' => Yii::$app->request->url, 'value' => Json::encode($images)]));
        return Json::encode($image);
    }

    /**
     * Updates an existing ImageInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ImageInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ImageInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImageInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImageInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
