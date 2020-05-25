<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Shedule */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Расписание', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
