<?php

namespace siasoft\qucms\controllers;

use Yii;
use siasoft\qucms\models\AuthItem;
use siasoft\qucms\models\search\AuthItem as AuthItemSearch;

class PermissionController extends \siasoft\qucms\web\Controller
{

    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(\yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(), ['AuthItem' => ['type' => AuthItem::TYPE_PERMISSION]]));
        $dataProvider->pagination->pageSize = 50;
        return $this->render(false, [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel
        ]);
    }

    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post())) {
            $time = time();
            $model->created_at = $time;
            $model->updated_at = $time;
            $model->type = AuthItem::TYPE_PERMISSION;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

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

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
