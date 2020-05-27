<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Shedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_add')->textInput() ?>

    <?= $form->field($model, 'user_approve')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'document')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
