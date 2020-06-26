<?php

namespace backend\controllers;

use Yii;
use common\models\Publications;
use backend\models\PublicationsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PublicationsController implements the CRUD actions for Publications model.
 */
class PublicationsController extends Controller
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
     * Lists all Publications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publications model.
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
     * Creates a new Publications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $students = \common\models\User::find()->select("students.id as id, user.email as email, user.last_name, user.first_name, user.middle_name")
            ->leftJoin('students', 'user.id = students.user_id')
            ->join('left join', 'auth_assignment', 'user.id = auth_assignment.user_id')
            ->where('auth_assignment.item_name = "Студент"')
            ->asArray()->all();

        $users = \common\models\User::find()
            ->leftJoin('auth_assignment', 'user.id = auth_assignment.user_id')
            ->where('auth_assignment.item_name = "Преподаватель"')
            ->asArray()->all();

        $publ = \common\models\PublIndexing::find()->asArray()->all();

        $model = new Publications();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'students' => $students,
            'users' => $users,
            'publ' => $publ,
        ]);
    }

    /**
     * Updates an existing Publications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $students = \common\models\User::find()->select("students.id as id, user.email as email, user.last_name, user.first_name, user.middle_name")
            ->leftJoin('students', 'user.id = students.user_id')
            ->join('left join', 'auth_assignment', 'user.id = auth_assignment.user_id')
            ->where('auth_assignment.item_name = "Студент"')
            ->asArray()->all();

        $users = \common\models\User::find()
            ->leftJoin('auth_assignment', 'user.id = auth_assignment.user_id')
            ->where('auth_assignment.item_name = "Преподаватель"')
            ->asArray()->all();

        $publ = \common\models\PublIndexing::find()->asArray()->all();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'students' => $students,
            'users' => $users,
            'publ' => $publ,
        ]);
    }

    /**
     * Deletes an existing Publications model.
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
     * Finds the Publications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
