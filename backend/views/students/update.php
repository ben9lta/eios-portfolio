<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $students array */
/* @var $group array */

$this->title = 'Редактирование: ' . $model->user->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="students-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'students' => $students,
        'group' => $group,
    ]) ?>

</div>
