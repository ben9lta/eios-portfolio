<?php

namespace backend\controllers;

use Yii;
use common\models\DocTypes;
use backend\models\DocTypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DocTypesController implements the CRUD actions for DocTypes model.
 */
class DocTypesController extends Controller
{
    /**
     * {@inheritdoc}
     */
     public function behaviors()
     {
         return [
             'verbs' => [
                 'class' => VerbFilter::className(),
                 'actions' => [
                     'delete' => ['POST'],
                 ],
             ],
             'access' => [
                 'class' => AccessControl::className(),
                 'rules' => [
                     [
                         'allow' => true,
                         'roles' => ['Администратор'],
                     ],
                 ],
             ],
         ];
     }

    /**
     * Lists all DocTypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocTypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocTypes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DocTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocTypes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $maintypes = \common\models\DocMaintypes::find()->asArray()->all();

        return $this->render('create', [
            'model' => $model,
            'maintypes' => $maintypes
        ]);
    }

    /**
     * Updates an existing DocTypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $maintypes = \common\models\DocMaintypes::find()->asArray()->all();

        return $this->render('update', [
            'model' => $model,
            'maintypes' => $maintypes
        ]);
    }

    /**
     * Deletes an existing DocTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocTypes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
