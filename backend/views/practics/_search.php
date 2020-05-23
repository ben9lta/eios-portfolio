<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PracticsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'place') ?>

    <?= $form->field($model, 'date_start') ?>

    <?= $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'document') ?>

    <?php // echo $form->field($model, 'diary') ?>

    <?php // echo $form->field($model, 'characteristic') ?>

    <?php // echo $form->field($model, 'evaluation') ?>

    <?php // echo $form->field($model, 'stud_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
