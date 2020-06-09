<?php

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $pbProvider yii\data\ActiveDataProvider */
/* @var $evProvider yii\data\ActiveDataProvider */

$this->title = 'Научная деятельность';
$this->params['breadcrumbs'][] = $this->title;

use common\modules\GridView\GridView;
use yii\helpers\Html;

?>

<!-- Блок "Публикации" -->
<div class="row mr-0">
    <div class="profile-edu ml-3 w-100">
        <div class="edu-head">
            <h4 class="mb-4 alert alert-warning">Публикации</h4>
        </div>
        <div class="edu-info">
            <?= GridView::widget([
                'dataProvider' => $pbProvider,
                'tableOptions' => ['class' => 'table table-bordered table-responsive-lg', 'style' => 'background-color: #f8f9fa'],
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'title',
//                        'headerOptions' => ['style' => 'width:24%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    [
                        'attribute' => 'user_id',
                        'label' => 'Научный руководитель',
                        'value' => 'user.fullName',
                    ],
                    'authors',
                    'date:date',
                    'description',
                    [
                        'attribute' => 'indexing_id',
                        'label' => 'Издание',
                        'value' => 'indexing.title'
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
<!-- Блок "Мероприятия" -->
<div class="row mr-0">
    <div class="profile-edu mr-3 pl-3 w-100">
        <div class="edu-head">
            <h4 class="mb-4 alert alert-warning">Мероприятия</h4>
        </div>
        <div class="edu-info">
            <?= GridView::widget([
                'dataProvider' => $evProvider,
                'tableOptions' => ['class' => 'table table-bordered table-responsive', 'style' => 'background-color: #f8f9fa'],
                'summary' => false,
                'columns' => [
                    'title',
                    'date_start:date',
                    'date_end:date',
                    'location',
                    'evaluation',
                    [
                        'attribute' => 'user_id',
                        'label' => 'Научный руководитель',
                        'value' => 'user.fullName',
                    ],
                    [
                        'attribute' => 'status_id',
                        'label' => 'Статус',
                        'value' => 'status.title',
                    ],
                    [
                        'attribute' => 'type_id',
                        'label' => 'Вид',
                        'value' => 'type.title',
                    ],
                    [
                        'attribute' => 'comment',
//                        'headerOptions' => ['style' => 'width:22%'],
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
