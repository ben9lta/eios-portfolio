<?php

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $achProvider yii\data\ActiveDataProvider */

$this->title = 'Достижения';
$this->params['breadcrumbs'][] = $this->title;

use common\modules\GridView\GridView;
use yii\helpers\Html;

?>

<!-- Блок "Достижения" -->
<div class="row mr-0">
    <div class="profile-edu ml-3 w-100">
        <div class="edu-head">
            <h4 class="mb-4 alert alert-warning">Достижения</h4>
        </div>
        <div class="edu-info">
            <?= GridView::widget([
                'dataProvider' => $achProvider,
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'headerOptions' => ['style' => 'width:25%'],
                        'contentOptions' => ['style'=>'white-space: normal;']
                    ],
                    'date:date',
                    'result',
                    [
                        'attribute' => 'status_id',
                        'label' => 'Статус',
                        'value' => 'title',
                        'headerOptions' => ['style' => 'width:15%'],
                    ],
                    [
                        'attribute' => 'type_id',
                        'label' => 'Вид',
                        'value' => 'title',
                        'headerOptions' => ['style' => 'width:15%'],
                    ],
                    [
                        'attribute' => 'comment',
                        'headerOptions' => ['style' => 'width:25%'],
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
