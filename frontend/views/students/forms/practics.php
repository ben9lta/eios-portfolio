<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $users array */

$this->title = Yii::$app->user->identity->fullName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practics-upload">

    <h1><?= Html::encode('Загрузка практик') ?></h1>

    <div class="practics-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'stud_id')->hiddenInput(['value' => Yii::$app->user->identity->students[0]->id])->label(false); ?>

        <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'place')->textarea(['maxlength' => true]) ?>


        <?php echo
            '<div class="row"> <div class="col-md-6">' .
            $form->field($model, 'date_start')->widget(
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
        ) . '</div>' . '<div class="col-md-6">' .

         $form->field($model, 'date_end')->widget(
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
        ) . '</div></div>';
        ?>

        <?= $form->field($model, 'evaluation')->textInput(['type' => 'number', 'placeholder' => '0 - 100', 'max' => '100', 'min' => '0']) ?>

        <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

        <label class="control-label"><?= $model->getAttributeLabel('document')?></label>
        <?= $form->field($model, 'file')->fileInput(['accept' => '.pdf, .doc, .docx, .rtf'])->label('') ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>