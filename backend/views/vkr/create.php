<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vkr */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'ВКР', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vkr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'students' => $students,
        'users' => $users,
    ]) ?>

</div>
