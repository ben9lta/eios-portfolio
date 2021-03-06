<?php

use common\models\storage\Storage;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$valueBirthday = $model->birthday ? Yii::$app->formatter->asDate(strtotime($model->birthday),'dd.MM.Y') : null;
?>

<div class="users-form">

    <?php
    $form = ActiveForm::begin();
    if(!empty($model->photo)) {
        echo Html::img(Storage::getFileUrl($model->photo), ['alt' => $model->getUserInitials()]);
        echo '<br>';
        echo Html::a('Удалить фотографию', ['delete-image', 'id' => $model->id], [
            'class' => 'btn btn-danger my-2',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить фотографию?',
                'method' => 'post',
            ],
        ]);
    }
    ?>

    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'new_pass')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'phone')->textInput(['type' => 'number', 'maxlength' => true])->widget(MaskedInput::className(), [
        'mask' => '+7 (999) 999-99-99',
        'options' => [
            'placeholder' => '+7 (999) 999-99-99'
        ],
    ]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'gender')->dropDownList(['' => '', 0 => 'Мужской', 1 => 'Женский']) ?>
        </div>
    </div>

    <?php if(Yii::$app->controller->action->id !== 'create')
        echo $form->field($model, 'status')->dropDownList(['' => '', 0 => 'Удален', 9 => 'Ожидает подтверждения', 10 => 'Подтвержден'])
    ?>

    <label class="control-label">Дата рождения</label>
    <?= DatePicker::widget([
        'name' => 'User[birthday]',
        'value' => $valueBirthday,
        'options' => ['placeholder' => 'Выберите дату'],
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'format' => 'dd.mm.yyyy',
            'todayHighlight' => true,
            'autoclose' => true,
        ]
    ]); ?>
    <p class="mb-3"></p>

    <?php if(Yii::$app->controller->action->id !== 'create') { ?>
        <label class="control-label"><?= $model->getAttributeLabel('photo')?></label>
        <?= $form->field($model, 'imageFile')->fileInput(['accept' => '.jpeg, .jpg, .png'])->label('') ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
