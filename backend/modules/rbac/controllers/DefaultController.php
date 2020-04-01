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
    public function actionIndex($page = 'Readme.md')
    {
        return $this->render('@app/modules/rbac/views/default/index.php', ['page' => $page]);
    }
}
