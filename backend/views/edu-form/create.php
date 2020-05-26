<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EduForm */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Форма образования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edu-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
