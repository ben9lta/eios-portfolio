<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Студенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

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
            'fullName',
            'groupName',
            [
                'attribute' => 'budget',
                'label' => 'Форма обучения',
                'filter' => ['0' => 'Коммерция', '1' => 'Бюджет'],
                'value' => 'Budget'
            ],
            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=> 'Действия',
                'filter' => Html::resetButton('Очистить', ['class' => 'btn btn-outline-secondary']),
            ],

        ],

    ]); ?>


</div>
