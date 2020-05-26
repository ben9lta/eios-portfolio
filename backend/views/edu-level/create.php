<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EduLevel */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Уровень образования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edu-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
