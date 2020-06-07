<?php

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $prProvider yii\data\ActiveDataProvider */
/* @var $vkrProvider yii\data\ActiveDataProvider */
/* @var $cwProvider yii\data\ActiveDataProvider */

$this->title = 'Учебная деятельность';
$this->params['breadcrumbs'][] = $this->title;

use common\modules\GridView\GridView;
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
                    'title',
                    [
                        'attribute' => 'user_id',
                        'label' => 'Научный руководитель',
                        'value' => 'user.fullName',
                    ],
                    'evaluation',
                    'comment',
                    'document'
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
                    'title',
                    'subject',
                    'evaluation',
                    'comment',
                    'document'
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
                    'title',
                    'place',
                    'date_start',
                    'date_end',
                    'evaluation',
                    'comment',
                    'document'
                ],
            ]);
            ?>
        </div>
    </div>
</div>
