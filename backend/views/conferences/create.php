<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Conferences */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Конференции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conferences-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
