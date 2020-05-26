<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DirectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Направления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'title',
            'code',
            'dep_id',
            'level_id',

            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],
        ],
    ]); ?>


</div>
