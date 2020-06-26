<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Achievements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="achievements-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(
        DatePicker::class,
        [
            'options' => ['placeholder' => 'Выберите дату'],
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'format' => 'dd.mm.yyyy',
                'todayHighlight' => true,
                'autoclose' => true,
            ]
        ]
    ); ?>

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

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($status, 'id', 'title'),
        'options' => ['placeholder' => 'Выберите статус'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
        ],
    ])->label('Статус');
    ?>

    <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($type, 'id', 'title'),
        'options' => ['placeholder' => 'Выберите тип'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
        ],
    ])->label('Тип');
    ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

    <label class="control-label"><?= $model->getAttributeLabel('document')?></label>
    <?= $form->field($model, 'file')->fileInput(['accept' => '.pdf, .doc, .docx, .rtf'])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
