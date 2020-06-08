<?php

use common\models\storage\Storage;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use common\models\User as Users;


/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$valueBirthday = $model->birthday ? Yii::$app->formatter->asDate(strtotime($model->birthday),'dd.MM.Y') : null;
?>

<div class="users-form">

    <?=
    array_keys(Yii::$app->authManager->getRolesByUser($model->id))[0] === 'Студент' ?
        '<div class="row"><div class="col-lg-6">'
        : '';
    ?>

    <?=
        '<div class="mb-4" style="text-align: center">' .
        Html::img(Storage::getFileUrl(
            (!empty($model->photo) ? $model->photo : Users::DEFAULT_USER_IMAGE)),
            ['alt' => $model->getUserInitials()]
        ) . '</div>';

    ?>
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?php
        if(array_keys(Yii::$app->authManager->getRolesByUser($model->id))[0] === 'Студент')
        {
            echo '<div class="row"><div class="col-md-6">'
                . $form->field($model, 'phone')->textInput(['type' => 'number', 'maxlength' => true])->widget(MaskedInput::className(), [
                    'mask' => '+7 (999) 999-99-99',
                    'options' => [
                        'placeholder' => '+7 (999) 999-99-99'
                    ],
                ]) . '</div><div class="col-md-6">' . $form->field($model, 'gender')->dropDownList(['' => '', 0 => 'Мужской', 1 => 'Женский']) .
            '</div></div>';
        }
        else
        {
            echo $form->field($model, 'phone')->textInput(['type' => 'number', 'maxlength' => true])->widget(MaskedInput::className(), [
                'mask' => '+7 (999) 999-99-99',
                'options' => [
                    'placeholder' => '+7 (999) 999-99-99'
                ],
            ]) . $form->field($model, 'gender')->dropDownList(['' => '', 0 => 'Мужской', 1 => 'Женский']);
        }
    ?>

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

    <?php
    if(array_keys(Yii::$app->authManager->getRolesByUser($model->id))[0] === 'Студент')
    {
        $hint_vkr = 'Файл с ВКР включает:  скан титульных листов с подписями;  скан задания и календарного плана выполнения ВКР с подписями;  аннотацию отчёта по ВКР;  содержательную часть отчёта ВКР и приложения;  скан отзывов;  скан рецензий (при наличии);  скан справки о внедрении результатов ВКР (при наличии);  скан справки о результатах прохождения проверки на антиплагиат.';
        $hint_cources = 'Файл курсовой работы включает: отсканированный титульный лист, имеющий все подписи участников образовательного процесса (три подписи комиссии, утв. в сентябре протоколом кафедры);  содержательную часть курсовой работы;  скан отзыва руководителя при наличии;  отчёты о прохождении практик, в т. ч. ПДП, и сопровождающую документацию.';
        $hint_practice = 'Файл практик включает: титульный лист и содержательную часть отчёта;  скан индивидуального задания по практике;  скан дневника и графика прохождения практики;  скан рецензии (характеристики) обучающегося с места практики;';
        echo '</div>';
        echo
        '<div class="col-lg-4 mx-auto"> 
            <div class="card">
                <div class="card-header">
                    Информация
                </div>
                <div class="card-body">
                    <h5 class="card-title">Учебная деятельность</h5>
                    <p class="card-text">Допустимый формат: pdf, doc, docx, rtf. 5Мб максимальный размер файла.</p>'
                    . '<div style="display: grid !important;grid-template-columns: 1fr 1fr 1fr;grid-column-gap: 1rem;">' .
                    Html::a('ВКР', ['students/upload-vkr'], ['class' => 'btn btn-light', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => $hint_vkr]) .
                    Html::a('Курсовые', ['students/upload-cources'], ['class' => 'btn btn-light', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => $hint_cources]) .
                    Html::a('Практики', ['students/upload-practics'], ['class' => 'btn btn-light', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => $hint_practice])
                    . '</div>
                </div>
                <hr/>
                <div class="card-body">
                    <h5 class="card-title">Научная деятельность</h5>
                    <p class="card-text">Допустимый формат: pdf, doc, docx, rtf. 5Мб максимальный размер файла.</p>'
                    . '<div style="display: grid !important;grid-template-columns: 1fr 1fr;grid-column-gap: 1rem;">' .
                    Html::a('Публикации', ['students/upload-publ'], ['class' => 'btn btn-light']) .
                    Html::a('Мероприятия', ['students/upload-events'], ['class' => 'btn btn-light'])
                    . '</div>
                </div>
                <hr/>
                <div class="card-body">
                    <h5 class="card-title">Внеучебные достижения</h5>
                    <p class="card-text">Чтобы загрузить ВКР, курсовые работы и практики, необходимо кликнуть по кнопке</p>'
                    . '<div style="display: grid !important;grid-template-columns: 1fr;grid-column-gap: 1rem;">' .
                    Html::a('Достижения', ['students/upload-achievements'], ['class' => 'btn btn-light'])
                    . '</div>
                </div>
            </div>
        </div>';
    }
    ?>

    <?php ActiveForm::end(); ?>

</div>
