<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мероприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

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
            'date_start:date',
            'date_end:date',
            'location',
            [
                'attribute' => 'document',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                }
            ],
            'evaluation',
            [
                'attribute' => 'student_id',
                'label' => 'Студент',
                'value' => function ($model) {
                    return $model->student->fullname;
                }
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Руководитель',
                'value' => function ($model) {
                    return $model->user->fullname;
                }
            ],
            [
                'attribute' => 'status_id',
                'label' => 'Статус',
                'value' => 'status.title',
            ],
            [
                'attribute' => 'type_id',
                'label' => 'Вид',
                'value' => 'type.title',
            ],
            'comment',

            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],
        ],
    ]); ?>


</div>
