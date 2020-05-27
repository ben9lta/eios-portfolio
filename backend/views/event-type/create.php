<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EventType */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Тип мероприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
