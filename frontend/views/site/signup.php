<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Регистрация';
?>
<div class="site-signup">
    <div class="card card-login card-container">
        <div class="thumbnail">
            <?= Html::img('https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg', ['class' => 'profile-img-card my-4'])?>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Логин'])->label(false) ?>

        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

        <?= $form->field($model, 'password_confirm')->passwordInput(['placeholder' => 'Повторите пароль'])->label(false) ?>

        <?php
        if(empty($model['consent'])) {
            echo $form->field($model, 'consent')->checkbox([])->label('Я соглашаюсь на ' . $this->render('../user/_modal', ['policy' => $this->render('/site/policy')]));
//                'label' => 'Я соглашаюсь на ' . $this->render('../user/_modal', ['policy' => $this->render('/site/policy')]),
//                'uncheck' => '',
//            ]);
        }
        ?>
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-lg btn-red btn-block', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
