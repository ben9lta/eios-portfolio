<?php

namespace backend\controllers;

use common\models\EventStatus;
use common\models\EventType;
use Yii;
use common\models\Events;
use backend\models\EventsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
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
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Events model.
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
     * Creates a new Events model.
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

        $type = EventType::find()->asArray()->all();
        $status = EventStatus::find()->asArray()->all();

        $model = new Events();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'type' => $type,
            'status' => $status,
            'users' => $users,
            'students' => $students
        ]);
    }

    /**
     * Updates an existing Events model.
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

        $type = EventType::find()->asArray()->all();
        $status = EventStatus::find()->asArray()->all();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'type' => $type,
            'status' => $status,
            'users' => $users,
            'students' => $students
        ]);
    }

    /**
     * Deletes an existing Events model.
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
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
