<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Achievements */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Достижения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="achievements-view">

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
            'date:date',
            'result',
            [
                'attribute' => 'document',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'fullName',
                'label' => 'Студент',
                'value' => function ($model) {
                    return $model->stud->fullname;
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
