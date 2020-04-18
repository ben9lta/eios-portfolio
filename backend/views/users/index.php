<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:5%'],
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->id),['users/view', 'id' => $data->id] );
                },
                'format' => 'raw'
            ],
            'first_name',
            'last_name',
            'middle_name',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => 'Status',
                'filter' => Html::activeDropDownList($searchModel, 'status',
                    [9 => 'В ожидании', 10 => 'Подтвержден'],
                    ['class'=>'form-control','prompt' => 'Все']
                ),
            ],
            [
                'attribute' => 'consent',
                'value' => 'Consent',
                'filter' => Html::activeDropDownList($searchModel, 'consent',
                    [0 => '-', 1 => '+'],
                    ['class'=>'form-control','prompt' => 'Все']
                ),
            ],
            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],

        ],
    ]); ?>


</div>
