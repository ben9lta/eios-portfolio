<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Practics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_start')->textInput() ?>

    <?= $form->field($model, 'date_end')->textInput() ?>

    <?= $form->field($model, 'document')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'characteristic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'evaluation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stud_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
