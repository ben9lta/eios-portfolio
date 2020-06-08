<?php

namespace frontend\controllers;

use common\models\Achievements;
use common\models\ActivityType;
use common\models\Courseworks;
use common\models\Events;
use common\models\EventStatus;
use common\models\EventType;
use common\models\Practics;
use common\models\Publications;
use common\models\Students;
use common\models\Vkr;
use frontend\models\students\StudentsSearch;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class StudentsController extends Controller
{

    public function behaviors()
    {
        $roles = User::$rolesList;
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new StudentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStudent($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionEdu($id)
    {
        $vkrProvider = new ActiveDataProvider([
            'query' => Vkr::find()->joinWith(['stud'])->where(['students.id' => $id]),
            'sort' => false,
        ]);

        $cwProvider = new ActiveDataProvider([
            'query' => Courseworks::find()->joinWith(['stud'])->where(['students.id' => $id]),
            'sort' => false,
        ]);

        $prProvider = new ActiveDataProvider([
            'query' => Practics::find()->joinWith(['stud'])->where(['students.id' => $id]),
            'sort' => false,
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'vkrProvider' => $vkrProvider,
            'cwProvider' => $cwProvider,
            'prProvider' => $prProvider,
        ]);
    }

    public function actionScience($id)
    {
        $evProvider = new ActiveDataProvider([
            'query' => Events::find()->joinWith(['student'])->where(['students.id' => $id]),
            'sort' => false,
        ]);

        $pbProvider = new ActiveDataProvider([
            'query' => Publications::find()->joinWith(['stud'])->where(['students.id' => $id]),
            'sort' => false,
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'evProvider' => $evProvider,
            'pbProvider' => $pbProvider,
        ]);
    }

    public function actionAchievements($id)
    {
        $achProvider = new ActiveDataProvider([
            'query' => Achievements::find()->joinWith(['stud'])->where(['students.id' => $id]),
            'sort' => false,
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'achProvider' => $achProvider,
        ]);
    }

    public function actionUploadVkr()
    {
        $model = new Vkr();
        $users = \common\models\User::find()->select(["user.id", "CONCAT(ifnull(concat(user.last_name, ' '), ''), ifnull(concat(user.first_name, ' '), ''), ifnull(user.middle_name, '')) as fio"])
            ->join('left join', 'auth_assignment', 'user.id = auth_assignment.user_id')
            ->where('auth_assignment.item_name = "Преподаватель"')
            ->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['students/edu', 'id' => $model->stud_id]);
        }

        return $this->render('forms/vkr', [
            'model' => $model,
            'users' => $users,
        ]);
    }

    public function actionUploadCources()
    {
        $model = new Courseworks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['students/edu', 'id' => $model->stud_id]);
        }

        return $this->render('forms/cources', [
            'model' => $model,
        ]);
    }

    public function actionUploadPractics()
    {
        $model = new Practics();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['students/edu', 'id' => $model->stud_id]);
        }

        return $this->render('forms/practics', [
            'model' => $model,
        ]);
    }

    public function actionUploadPubl()
    {
        $model = new Publications();

        $publ = \common\models\PublIndexing::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['students/science', 'id' => $model->stud_id]);
        }

        return $this->render('forms/publ', [
            'model' => $model,
            'publ' => $publ,
        ]);
    }

    public function actionUploadEvents()
    {
        $model = new Events();

        $type = EventType::find()->asArray()->all();
        $status = EventStatus::find()->asArray()->all();

        $users = \common\models\User::find()->select(["user.id", "CONCAT(ifnull(concat(user.last_name, ' '), ''), ifnull(concat(user.first_name, ' '), ''), ifnull(user.middle_name, '')) as fio"])
            ->join('left join', 'auth_assignment', 'user.id = auth_assignment.user_id')
            ->where('auth_assignment.item_name = "Преподаватель"')
            ->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['students/science', 'id' => $model->student_id]);
        }

        return $this->render('forms/events', [
            'model' => $model,
            'type' => $type,
            'status' => $status,
            'users' => $users,
        ]);
    }

    public function actionUploadAchievements()
    {
        $model = new Achievements();

        $type = ActivityType::find()->asArray()->all();
        $status = EventStatus::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['students/achievements', 'id' => $model->stud_id]);
        }

        return $this->render('forms/achieve', [
            'model' => $model,
            'type' => $type,
            'status' => $status,
        ]);
    }

    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Students::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
