<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PublicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-index">

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
            'authors',
            [
                'attribute' => 'document',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                }
            ],
            'date:date',
            'description',
            [
                'attribute' => 'indexing_id',
                'label' => 'Индексация',
                'value' => 'indexing.title'
            ],
            [
                'attribute' => 'stud_id',
                'label' => 'Студент',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->stud->user->fullName, ['students/view', 'id' => $model->stud_id], ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Научный руководитель',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->user->fullName, ['users/view', 'id' => $model->user_id], ['target' => '_blank']);
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
