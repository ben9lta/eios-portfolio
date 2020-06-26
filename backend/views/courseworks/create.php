<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Courseworks */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Курсовые работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courseworks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'students' => $students,
    ]) ?>

</div>
