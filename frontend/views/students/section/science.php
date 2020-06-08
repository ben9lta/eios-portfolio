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
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'headerOptions' => ['style' => 'width:24%'],
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
    <div class="profile-edu ml-3 w-100">
        <div class="edu-head">
            <h4 class="mb-4 alert alert-warning">Мероприятия</h4>
        </div>
        <div class="edu-info">
            <?= GridView::widget([
                'dataProvider' => $evProvider,
                'summary' => false,
                'columns' => [
                    'title',
                    'date_start',
                    'date_end',
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
                        'value' => 'title',
                    ],
                    [
                        'attribute' => 'type_id',
                        'label' => 'Вид',
                        'value' => 'title',
                    ],
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
