<?php

namespace siasoft\qucms\controllers;

use Yii;
use siasoft\qucms\models\RealEstate;
use siasoft\qucms\models\search\RealEstate as RealEstateSearch;
use siasoft\qucms\web\controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RealEstateController implements the CRUD actions for RealEstate model.
 */
class RealEstateController extends controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['generate'],
                        'allow' => true,
                        //'roles' => ['?'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RealEstate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RealEstateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        //$dataProvider->pagination->pageSize = 10;
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single RealEstate model.
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
     * Creates a new RealEstate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RealEstate;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RealEstate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RealEstate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    private function randString($length)
    {

    }

    public function actionGenerate()
    {
        set_time_limit(0);
                $strings = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
Fusce aliquet pede non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla.
Donec blandit feugiat ligula. Donec hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl eget sapien. Donec ut est in lectus consequat consequat.
Etiam eget dui. Aliquam erat volutpat. Sed at lorem in nunc porta tristique.
Proin nec augue. Quisque aliquam tempor magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
Nunc ac magna. Maecenas odio dolor, vulputate vel, auctor ac, accumsan id, felis. Pellentesque cursus sagittis felis.
Pellentesque porttitor, velit lacinia egestas auctor, diam eros tempus arcu, nec vulputate augue magna vel risus. Cras non magna vel ante adipiscing rhoncus. Vivamus a mi.
Morbi neque. Aliquam erat volutpat. Integer ultrices lobortis eros.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin semper, ante vitae sollicitudin posuere, metus quam iaculis nibh, vitae scelerisque nunc massa eget pede. Sed velit urna, interdum vel, ultricies vel, faucibus at, quam.
Donec elit est, consectetuer eget, consequat quis, tempus quis, wisi. In in nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.
Donec ullamcorper fringilla eros. Fusce in sapien eu purus dapibus commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
Cras faucibus condimentum odio. Sed ac ligula. Aliquam at eros.
Etiam at ligula et tellus ullamcorper ultrices. In fermentum, lorem non cursus porttitor, diam urna accumsan lacus, sed interdum wisi nibh nec nisl. Ut tincidunt volutpat urna.
Mauris eleifend nulla eget mauris. Sed cursus quam id felis. Curabitur posuere quam vel nibh.
Cras dapibus dapibus nisl. Vestibulum quis dolor a felis congue vehicula. Maecenas pede purus, tristique ac, tempus eget, egestas quis, mauris.
Curabitur non eros. Nullam hendrerit bibendum justo. Fusce iaculis, est quis lacinia pretium, pede metus molestie lacus, at gravida wisi ante at libero.
Quisque ornare placerat risus. Ut molestie magna at mi. Integer aliquet mauris et nibh.
Ut mattis ligula posuere velit. Nunc sagittis. Curabitur varius fringilla nisl.
Duis pretium mi euismod erat. Maecenas id augue. Nam vulputate.
Duis a quam non neque lobortis malesuada. Praesent euismod. Donec nulla augue, venenatis scelerisque, dapibus a, consequat at, leo.
Pellentesque libero lectus, tristique ac, consectetuer sit amet, imperdiet ut, justo. Sed aliquam odio vitae tortor. Proin hendrerit tempus arcu.
In hac habitasse platea dictumst. Suspendisse potenti. Vivamus vitae massa adipiscing est lacinia sodales.
Donec metus massa, mollis vel, tempus placerat, vestibulum condimentum, ligula. Nunc lacus metus, posuere eget, lacinia eu, varius quis, libero. Aliquam nonummy adipiscing augue.
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
Fusce aliquet pede non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla.
Donec blandit feugiat ligula. Donec hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl eget sapien. Donec ut est in lectus consequat consequat.
Etiam eget dui. Aliquam erat volutpat. Sed at lorem in nunc porta tristique.
Proin nec augue. Quisque aliquam tempor magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
Nunc ac magna. Maecenas odio dolor, vulputate vel, auctor ac, accumsan id, felis. Pellentesque cursus sagittis felis.
Pellentesque porttitor, velit lacinia egestas auctor, diam eros tempus arcu, nec vulputate augue magna vel risus. Cras non magna vel ante adipiscing rhoncus. Vivamus a mi.
Morbi neque. Aliquam erat volutpat. Integer ultrices lobortis eros.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin semper, ante vitae sollicitudin posuere, metus quam iaculis nibh, vitae scelerisque nunc massa eget pede. Sed velit urna, interdum vel, ultricies vel, faucibus at, quam.
Donec elit est, consectetuer eget, consequat quis, tempus quis, wisi. In in nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.
Donec ullamcorper fringilla eros. Fusce in sapien eu purus dapibus commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
Cras faucibus condimentum odio. Sed ac ligula. Aliquam at eros.
Etiam at ligula et tellus ullamcorper ultrices. In fermentum, lorem non cursus porttitor, diam urna accumsan lacus, sed interdum wisi nibh nec nisl. Ut tincidunt volutpat urna.
Mauris eleifend nulla eget mauris. Sed cursus quam id felis. Curabitur posuere quam vel nibh.
Cras dapibus dapibus nisl. Vestibulum quis dolor a felis congue vehicula. Maecenas pede purus, tristique ac, tempus eget, egestas quis, mauris.
Curabitur non eros. Nullam hendrerit bibendum justo. Fusce iaculis, est quis lacinia pretium, pede metus molestie lacus, at gravida wisi ante at libero.
Quisque ornare placerat risus. Ut molestie magna at mi. Integer aliquet mauris et nibh.
Ut mattis ligula posuere velit. Nunc sagittis. Curabitur varius fringilla nisl.
Duis pretium mi euismod erat. Maecenas id augue. Nam vulputate.";
        $strings = explode("\n", $strings);
        for ($index1 = 0; $index1 < 1; $index1++) {
            $transaction = Yii::$app->db->beginTransaction();
            for ($index = 0; $index < 10; $index++) {
                $re = new RealEstate();
                $re->operation_id = mt_rand();
                $re->type_id = mt_rand();
                $re->created_by = mt_rand();
                $re->owner = mt_rand();
                $re->customer_id = mt_rand();
                $re->floor = mt_rand(0, 99);
                $re->floors = mt_rand(0, 99);
                $re->square_all = doubleval(mt_rand(0, 9999) . '.') . mt_rand(0, 99);
                $re->square_living = doubleval(mt_rand(0, 999) . '.') . mt_rand(0, 99);
                $re->square_kitchen = doubleval(mt_rand(0, 99) . '.') . mt_rand(0, 99);
                $re->square_balcony = doubleval(mt_rand(0, 99) . '.') . mt_rand(0, 99);
                $re->square_bathroom = doubleval(mt_rand(0, 99) . '.') . mt_rand(0, 99);
                $re->bathroom_count = mt_rand(0, 9);
                $re->ceiling_height = doubleval(mt_rand(0, 99) . '.') . mt_rand(0, 99);
                $re->room_count = mt_rand(0, 99);
                $re->created_at = time();
                $re->updated_at = time();
                $re->updated_by = mt_rand();
                $re->is_active = mt_rand(0, 1);
                $re->for_export = mt_rand(0, 1);
                $re->to_site = mt_rand(0, 1);
                $re->is_elite = mt_rand(0, 1);
                $re->is_deleted = mt_rand(0, 1);
                //$re->date_deleted = '';
                //$re->date_sale = 1;
                $re->is_saled = mt_rand(0, 1);
                $re->is_draft = mt_rand(0, 1);
                $re->price = mt_rand();
                $re->price_hidden = mt_rand(0, 1);
                $re->auction = mt_rand(0, 1);
                //$re->rented_from = 1;
                //$re->rented_to = 1;
                $re->description = $strings[mt_rand(0, 54)];
                $re->description_for_site = $strings[mt_rand(0, 54)];
                $re->description_near = $strings[mt_rand(0, 54)];
                $re->contract_id = mt_rand();
                $re->ID_country = mt_rand(0, 999);
                $re->ID_region = mt_rand(0, 9999);
                $re->ID_city = mt_rand(0, 9999);
                $re->address = 1;
                $re->is_new_building = mt_rand(0, 1);
                //$re->сompletion_date = 1;
                $re->lat = doubleval(mt_rand(0, 9999) . '.') . mt_rand(0, 99999);
                $re->lng = doubleval(mt_rand(0, 9999) . '.') . mt_rand(0, 99999);
                $re->year_build = mt_rand(0, 9999);
                $re->save(false);
            }
            $transaction->commit();
        }
        $this->redirect(['index']);
    }

    /**
     * Finds the RealEstate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RealEstate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RealEstate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
