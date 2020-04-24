<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PublIndexing */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Индексы публикаций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publ-indexing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
