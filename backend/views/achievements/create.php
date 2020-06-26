<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Achievements */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Достижения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type,
        'status' => $status,
        'students' => $students,
        'users' => $users,
    ]) ?>

</div>
