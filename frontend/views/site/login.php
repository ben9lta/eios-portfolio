<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Вход';
//$this->params['breadcrumbs'][] = $this->title;

//$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#login-password-form').attr('type',this.checked?'text':'password');})");

?>
<div class="site-login">
    <div class="card card-login card-container">
<!--        <h1 class="text-center">--><?//= Html::encode($this->title) ?><!--</h1>-->
        <div class="thumbnail">
    <!--        --><?//= Html::img('@common/images/hat.png', ['class' => 'profile-img-card my-4'])?>
            <?= Html::img('https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg', ['class' => 'profile-img-card my-4'])?>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Логин'])->label(false) ?>
<!--            <div class="reveal-password">-->
<!--                --><?//= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?>
<!--                --><?//= Html::label('', ['for' => 'reveal-password']) ?>
<!--            </div>-->
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль', 'id' => 'login-password-form'])->label(false) ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-lg btn-red btn-block', 'name' => 'login-button']) ?>
            </div>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Восстановить пароль.', ['site/request-password-reset'], ['class' => 'color-red']) ?>
                <br>
                <?= Html::a('Отрпавить письмо с подтверждением.', ['site/resend-verification-email'], ['class' => 'color-red']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
