<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CourseworksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Курсовые работы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courseworks-index">

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
            'subject',
            'title',
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
                'value' => "stud.fullName",
                'label'=> "Студент"
            ],
            'comment',

            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],
        ],
    ]); ?>


</div>
