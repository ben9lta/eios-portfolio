<?php


namespace common\modules\GridView;

use yii\grid\GridView as GV;
use yii\helpers\Html;

class GridView extends GV
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public $tableOptions = ['class' => 'table table-sm table-responsive-md'];
}