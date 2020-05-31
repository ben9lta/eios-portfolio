<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Students */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="students-view">

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
            [
                'label' => 'ФИО',
                'attribute' => 'user_id',
                'value' => $model->user->fullname
            ],
            [
                'label' => 'Группа',
                'attribute' => 'group_id',
                'value' => $model->group->title
            ],
            [
                'label' => 'Форма обучения',
                'attribute' => 'budget',
                'value' => $model->getBudget()
            ],

        ],
    ]) ?>

</div>
