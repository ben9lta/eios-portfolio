<?php

use common\modules\GridView\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\students\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Поиск студентов';
?>

<div class="students-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'fullName',
                'value' => 'fullName',
                'filter' =>  Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fullName',
                    'data' => ArrayHelper::map(\common\models\Students::find()
                        ->select(["students.id", "user_id", "CONCAT(ifnull(concat(user.last_name, ' '), ''), ifnull(concat(user.first_name, ' '), ''), ifnull(user.middle_name, '')) as fio"])
                        ->leftJoin('user', 'user.id = students.user_id')->asArray()->all(), 'id', 'fio'),
                    'value' => 'fullName ',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Студент'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]),
            ],
            [
                'attribute' => 'groupName',
                'value' => 'group.title',
                'filter' =>  Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'group_id',
                    'data' => ArrayHelper::map(\common\models\Group::find()->asArray()->all(), 'id', 'title'),
                    'value' => 'group.title',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Код группы'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]),
            ],
            [
                'attribute' => 'department',
                'label' => 'Кафедра',
                'value' => 'group.dir.dep.title',
                'filter' =>  Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'department',
                    'data' => ArrayHelper::map(\common\models\Department::find()->all(), 'id', 'title', 'inst.title'),
                    'value' => 'group.dir.dep.title',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Кафедра'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]),
            ],
            [
                'attribute' => 'direction',
                'label' => 'Направление',
                'value' => 'group.dir.code',
                'filter' =>  Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'direction',
                    'data' => ArrayHelper::map(\common\models\Direction::find()->asArray()->all(), 'id', 'code'),
                    'value' => 'group.dir.code',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Шифр'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                     ]
                ]),
            ],
//            [
//                'attribute' => 'budget',
//                'label' => 'Форма обучения',
//                'value' => 'Budget',
//                'filter' =>  Select2::widget([
//                    'model' => $searchModel,
//                    'attribute' => 'budget',
//                    'data' => ['0' => 'Коммерция', '1' => 'Бюджет'],
//                    'value' => 'Budget',
//                    'options' => [
//                        'class' => 'form-control',
//                        'placeholder' => 'Выберите значение'
//                    ],
//                    'pluginOptions' => [
//                        'allowClear' => true,
//                        'selectOnClose' => true,
//                    ]
//                ]),
//            ],

            [
                'class' => 'common\modules\GridView\ActionColumn',
                'template' => '',
                'header'=> 'Действия',
                'filter' => Html::resetButton('Очистить', ['class' => 'btn btn-outline-secondary']),
            ],

        ],
    ]); ?>

</div>

