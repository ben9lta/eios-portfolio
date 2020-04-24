<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ConfType */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Виды конференций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conf-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
