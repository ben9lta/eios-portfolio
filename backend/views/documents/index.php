<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">

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
            [
                'attribute' => 'user_add_id',
                'value' => "profAdd.fullName",
                'label'=> "Добавил"
            ],
            [
                'attribute' => 'user_approve_id',
                'value' => "profApprove.fullName",
                'label'=> "Заверил"
            ],
            'docTypeName',
            'title',
            'document',
            'comment',
            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],

        ],
    ]); ?>


</div>
