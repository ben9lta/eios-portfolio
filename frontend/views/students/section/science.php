<?php

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $pbProvider yii\data\ActiveDataProvider */
/* @var $evProvider yii\data\ActiveDataProvider */

$this->title = 'Научная деятельность';
$this->params['breadcrumbs'][] = $this->title;

use common\modules\GridView\GridView;
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
                    'title',
                    [
                        'attribute' => 'user_id',
                        'label' => 'Научный руководитель',
                        'value' => 'user.fullName',
                    ],
                    'authors',
                    'date',
                    'description',
                    [
                        'attribute' => 'indexing_id',
                        'label' => 'Издание',
                        'value' => 'indexing.title'
                    ],
                    'document',
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
                    'comment',
                    'document',
                ],
            ]);
            ?>
        </div>
    </div>
</div>
