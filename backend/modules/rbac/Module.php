<?php

namespace app\modules\rbac;
use Yii;

/**
 * rbac module definition class
 */
class Module extends \mdm\admin\Module
{
    public function init()
    {
        parent::init();
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            /* @var $action \yii\base\Action */
            $view = $action->controller->getView();
            $view->params['breadcrumbs'][0]['label'] = 'Управление доступом';
            $view->params['breadcrumbs'][0]['url'] = '/rbac';
            return true;
        }
        return false;
    }
}
