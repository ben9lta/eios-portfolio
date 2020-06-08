<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vkr */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'ВКР', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->stud->user->fullname;
\yii\web\YiiAsset::register($this);
?>
<div class="vkr-view">

    <h1><?= Html::encode($model->stud->user->fullname) ?></h1>

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
                'value' => function ($model) {
                    return $model->stud->user->fullname;
                }
            ],
            'user_id',
            'comment',
        ],
    ]) ?>

</div>
