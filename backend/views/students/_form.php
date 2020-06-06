<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $form yii\widgets\ActiveForm */
/* @var $students array */
/* @var $group array */
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?php
    if(Yii::$app->controller->action->id !== "update")
        echo $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($students, 'id', 'email'),
            'options' => ['placeholder' => 'Выберите пользователя'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
            ],
        ])->label('Email Пользователя');
    else
        echo $form->field($model, 'fullName')->textInput(['readonly' => true]);
    ?>

    <?=
    $form->field($model, 'groupName')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($group, 'id', 'title'),
        'options' => ['placeholder' => 'Выберите группу'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
        ],
    ]);
    ?>

    <?= $form->field($model, 'budget')->dropDownList(['' => '', 0 => 'Коммерция', 1 => 'Бюджет']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
