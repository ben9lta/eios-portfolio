<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DocTypes */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Тип документов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
