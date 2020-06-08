<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $users array */

$this->title = Yii::$app->user->identity->fullName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courseworks-upload">

    <h1><?= Html::encode('Загрузка курсовых работ') ?></h1>

    <div class="courseworks-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'stud_id')->hiddenInput(['value' => Yii::$app->user->identity->students[0]->id])->label(false); ?>

        <?= $form->field($model, 'subject')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'evaluation')->textInput(['type' => 'number', 'placeholder' => '0 - 100', 'max' => 100, 'min' => 0]) ?>

        <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

        <label class="control-label"><?= $model->getAttributeLabel('document')?></label>
        <?= $form->field($model, 'file')->fileInput(['accept' => '.pdf, .doc, .docx, .rtf'])->label('') ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>