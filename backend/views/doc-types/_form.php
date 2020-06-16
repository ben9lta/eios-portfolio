<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'doc_maintypes_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($maintypes, 'id', 'title'),
        'options' => ['placeholder' => 'Выберите главный тип'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0, //Кол-во символов для поиска и вывода информации
        ],
    ]);
    ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
