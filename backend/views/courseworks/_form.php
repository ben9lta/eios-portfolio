<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Courseworks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courseworks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'evaluation')->textInput(['type' => 'number', 'placeholder' => '0 - 100', 'max' => 100, 'min' => 0]) ?>

    <?=
    $form->field($model, 'stud_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($students, 'id', function($model){return $model['last_name'] . ' ' . $model['first_name'];}, 'email'),
        'options' => ['placeholder' => 'Выберите студента'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
        ],
    ])->label('Студент');
    ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

    <label class="control-label"><?= $model->getAttributeLabel('document')?></label>
    <?= $form->field($model, 'file')->fileInput(['accept' => '.pdf, .doc, .docx, .rtf'])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
