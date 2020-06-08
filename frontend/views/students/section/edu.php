<?php

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $prProvider yii\data\ActiveDataProvider */
/* @var $vkrProvider yii\data\ActiveDataProvider */
/* @var $cwProvider yii\data\ActiveDataProvider */

$this->title = 'Учебная деятельность';
$this->params['breadcrumbs'][] = $this->title;

use common\modules\GridView\GridView;
use yii\helpers\Html;

?>

<!-- Блок "ВКР" -->
<div class="row mr-0">
    <div class="profile-edu ml-3 w-100">
        <div class="edu-head">
            <h4 class="mb-4 alert alert-warning">Выпускная квалификационная работа</h4>
        </div>
        <div class="edu-info">
            <?= GridView::widget([
                'dataProvider' => $vkrProvider,
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'value' => 'title',
                        'headerOptions' => ['style' => 'width:30%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    [
                        'attribute' => 'user_id',
                        'label' => 'Научный руководитель',
                        'value' => 'user.fullName',
                        'headerOptions' => ['style' => 'width:20%'],
                    ],
                    'evaluation',
                    [
                        'attribute' => 'comment',
                        'headerOptions' => ['style' => 'width:15%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    [
                        'attribute' => 'document',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                        }
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
<hr/>
<!-- Блок "Курсовые работы" -->
<div class="row mr-0">
    <div class="profile-edu ml-3 w-100">
        <div class="edu-head">
            <h4 class="mb-4 alert alert-warning">Курсовые работы</h4>
        </div>
        <div class="edu-info">
            <?= GridView::widget([
                'dataProvider' => $cwProvider,
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'headerOptions' => ['style' => 'width:35%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    [
                        'attribute' => 'subject',
                        'headerOptions' => ['style' => 'width:35%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    'evaluation',
                    [
                        'attribute' => 'comment',
                        'headerOptions' => ['style' => 'width:20%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    [
                        'attribute' => 'document',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                        }
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
<hr/>
<!-- Блок "Практика" -->
<div class="row mr-0">
    <div class="profile-edu ml-3 w-100">
        <div class="edu-head">
            <h4 class="mb-4 alert alert-warning">Практика</h4>
        </div>
        <div class="edu-info">
            <?= GridView::widget([
                'dataProvider' => $prProvider,
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'headerOptions' => ['style' => 'width:24%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    [
                        'attribute' => 'place',
                        'headerOptions' => ['style' => 'width:24%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    'date_start:date',
                    'date_end:date',
                    'evaluation',
                    [
                        'attribute' => 'comment',
                        'headerOptions' => ['style' => 'width:22%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    [
                        'attribute' => 'document',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a('Посмотреть', \common\models\storage\Storage::getFileUrl($model->document), ['target' => '_blank']);
                        }
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
