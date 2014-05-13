<?php

namespace siasoft\qucms\controllers;

use Yii;
use \yii\helpers\ArrayHelper;
use siasoft\qucms\models\AuthItem;
use siasoft\qucms\models\search\AuthItem as AuthItemSearch;

class RoleController extends \siasoft\qucms\web\Controller
{

    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->searchRoles(Yii::$app->request->getQueryParams());
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
            $model->type = \yii\rbac\item::TYPE_ROLE;
            if ($model->save()) {
                $this->updatePermissions($model->name, Yii::$app->request->post()['permission']);
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'permissions' => $this->getPermissions('')
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = time();
            if ($model->save()) {
                $this->updatePermissions($id, Yii::$app->request->post()['permission']);
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'permissions' => $this->getPermissions($id)
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function updatePermissions($role, $array)
    {
        $insert = '';
        $delete = '';
        foreach ($array as $key => $value) {
            $v = ArrayHelper::getValue($value, 'value', '');
            if ($value['original'] !== $v) {
                if ($v) {
                    $insert.="('{$role}', '{$key}'),";
                } else {
                    $delete.="child='{$key}' OR ";
                }
            }
        }
        if ($insert) {
            $insert = mb_substr($insert, 0, -1);
            Yii::$app->db->createCommand('INSERT INTO auth_item_child(parent, child) VALUES ' . $insert)->execute();
        }
        if ($delete) {
            $delete = mb_substr($delete, 0, -4);
            Yii::$app->db->createCommand("DELETE FROM auth_item_child WHERE parent='{$role}' AND (" . $delete . ')')->execute();
        }
    }

    protected function getPermissions($name)
    {
        $query = new \yii\db\Query();
        $subquery = new \yii\db\Query();
        $subquery->select('child, true `on`')->from('auth_item_child')->where("parent = '{$name}'");
        return $query->select('`name`, `description`, ttt.`on`')->from('auth_item')->join('LEFT JOIN', ['ttt' => $subquery], 'auth_item.name = ttt.child')->where('type = ' . \yii\rbac\Item::TYPE_PERMISSION)->all();
    }

    protected function findModel($name)
    {
        if (($model = AuthItem::findOne($name)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
