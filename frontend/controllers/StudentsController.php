<?php

namespace frontend\controllers;

use common\models\Achievements;
use common\models\Courseworks;
use common\models\Events;
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
