<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $users array */
/* @var $status array */
/* @var $type array */

$this->title = Yii::$app->user->identity->fullName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-upload">

    <h1><?= Html::encode('Загрузка мероприятий') ?></h1>

    <div class="events-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'student_id')->hiddenInput(['value' => Yii::$app->user->identity->students[0]->id])->label(false); ?>

        <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'evaluation')->textInput()->label('Награда') ?>

        <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($status, 'id', 'title'),
            'options' => ['placeholder' => 'Выберите группу'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
            ],
        ])->label('Статус');
        ?>

        <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($type, 'id', 'title'),
            'options' => ['placeholder' => 'Выберите группу'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
            ],
        ])->label('Тип');
        ?>

        <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($users, 'id', 'fio'),
            'options' => ['placeholder' => 'Выберите руководителя'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
            ],
        ])->label('Руководитель');
        ?>

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

        <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

        <label class="control-label"><?= $model->getAttributeLabel('document')?></label>
        <?= $form->field($model, 'file')->fileInput(['accept' => '.pdf, .doc, .docx, .rtf'])->label('') ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>