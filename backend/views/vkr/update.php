<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vkr */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'ВКР', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stud->user->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="vkr-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
