<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Practics */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Практики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="practics-view">

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
            'place',
            'date_start:date',
            'date_end:date',
            [
                'attribute' => 'document',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                }
            ],
//            'diary',
//            'characteristic',
            'evaluation',
            [
                'attribute' => 'fullName',
                'label' => 'Студент',
                'value' => function ($model) {
                    return $model->stud->user->fullname;
                }
            ],
            'comment',
        ],
    ]) ?>

</div>
