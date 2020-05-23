<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AchievementsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="achievements-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'document') ?>

    <?php // echo $form->field($model, 'stud_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
