<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConferencesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Конференции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conferences-index">

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
            'date_start',
            'date_end',
            'location',
            //'document',
            //'program',
            //'comments:ntext',
            //'student_id',
            //'status_id',
            //'type_id',

            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],
        ],
    ]); ?>


</div>
