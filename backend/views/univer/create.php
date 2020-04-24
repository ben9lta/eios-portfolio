<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Univer */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Университеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="univer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
