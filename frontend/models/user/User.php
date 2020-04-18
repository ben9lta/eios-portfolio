<?php

namespace frontend\models\user;

use backend\models\users\Users as BUsers;
use yii\base\Model;

class User extends Model
{
    private $model;

    public function __construct(BUsers $model, $config = [])
    {
        $this->model = $model;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
    }

}