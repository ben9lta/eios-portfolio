<?php

use common\models\storage\Storage;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use common\models\User as Users;


/* @var $this yii\web\View */
/* @var $model frontend\models\user\User */
/* @var $form yii\widgets\ActiveForm */

$valueBirthday = $model['birthday'] ? Yii::$app->formatter->asDate(strtotime($model['birthday']),'dd.MM.Y') : null;
?>

<div class="users-form">

    <?=
        Html::img(Storage::getFileUrl(
            (!empty($model['photo']) ? $model['photo'] : Users::DEFAULT_USER_IMAGE)),
            ['alt' => Users::getUserInitials($model["username"])]
        );

    ?>
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['type' => 'number', 'maxlength' => true])->widget(MaskedInput::className(), [
        'mask' => '+7 (999) 999-99-99',
        'options' => [
            'placeholder' => '+7 (999) 999-99-99'
        ],
    ]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['' => '', 1 => 'Мужской', 2 => 'Женский']) ?>

    <label class="control-label">Дата рождения</label>
    <?= DatePicker::widget([
        'name' => 'Users[birthday]',
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

    <label class="control-label"><?= $model->getAttributeLabel('photo')?></label>
    <?= $form->field($model, 'imageFile')->fileInput(['accept' => '.jpeg, .jpg, .png'])->label('') ?>

    <?php
        if(empty($model['consent'])) {
           echo $form->field($model, 'consent')->checkbox([
                'label' => 'Я соглашаюсь на ' . $this->render('_modal', ['policy' => $this->render('/site/policy')]),
                'uncheck' => '',
            ]);
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
