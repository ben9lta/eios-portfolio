<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Events */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="events-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'value' => function ($model) {
                    return $model->status->title;
                }
            ],
            [
                'attribute' => 'status_id',
                'label' => 'Вид',
                'value' => function ($model) {
                    return $model->type->title;
                }
            ],
            'comment',
        ],
    ]) ?>

</div>
