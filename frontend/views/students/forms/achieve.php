<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $users array */

$this->title = Yii::$app->user->identity->fullName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vkr-upload">

    <h1><?= Html::encode('Загрузка достижений') ?></h1>

    <div class="vkr-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'stud_id')->hiddenInput(['value' => Yii::$app->user->identity->students[0]->id])->label(false); ?>

        <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

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
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>