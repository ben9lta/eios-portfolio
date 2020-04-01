<?php

namespace app\modules\rbac\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `rbac` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @param string $page
     * @return string
     */
    public function actionIndex($page = 'user')
    {
        if (strpos($page, '.png') !== false) {
            $file = Yii::getAlias("@mdm/admin/{$page}");
            return Yii::$app->getResponse()->sendFile($file);
        }
        return $this->render('index', ['page' => $page]);
    }
}
