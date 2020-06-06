<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $students common\models\User */
/* @var $group common\models\Group */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'students' => $students,
        'group' => $group,
    ]) ?>

</div>
