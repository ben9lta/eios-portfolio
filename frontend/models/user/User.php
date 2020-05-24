<?php

namespace frontend\models\user;

use common\models\User as Users;
use yii\base\Model;

class User extends Model
{
    private $model;

    public function __construct(Users $model, $config = [])
    {
        $this->model = $model;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
    }

}