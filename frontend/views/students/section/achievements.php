<?php

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $achProvider yii\data\ActiveDataProvider */

$this->title = 'Достижения';
$this->params['breadcrumbs'][] = $this->title;

use common\modules\GridView\GridView;
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
                    'title',
                    'date',
                    'result',
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
