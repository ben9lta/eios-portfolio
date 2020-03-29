<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        // добавляем роль "Администратор"
        $admin = $auth->createRole('Администратор');
        $auth->add($admin);

        // добавляем роль "Студент"
        $student = $auth->createRole("Студент");
        $auth->add($student);
    }

}
