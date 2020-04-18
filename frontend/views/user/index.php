<?php
/* @var $this yii\web\View */

use yii\bootstrap4\Html;
?>

<div class="profile-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
