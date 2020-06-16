<?php

use yii\helpers\Html;
use common\modules\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы документов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-types-index">

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
            'title',
            [
                'attribute' => 'mainTypeName',
                'value' => "docMaintypes.title",
                'label'=> "Главный тип документа"
            ],
            'comment',
            [
                'class' => 'common\modules\GridView\ActionColumn',
                'header'=>'Действия',
            ],
        ],
    ]); ?>


</div>
