<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PracticsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Практики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            'id',
            'title',
            'place',
//            'date_start:date',
//            'date_end:date',
            [
                'attribute' => 'document',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                }
            ],
            'evaluation',
            [
                'attribute' => 'stud_id',
                'label' => 'Студент',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->stud->user->fullName, ['students/view', 'id' => $model->stud_id], ['target' => '_blank']);
                }
            ],
            'comment',

            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],
        ],
    ]); ?>


</div>
