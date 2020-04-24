<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConfTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды конференций';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conf-type-index">

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

            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],
        ],
    ]); ?>


</div>
