<?php

use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model common\models\db\Tables */

$this->title = 'Административная часть';
?>
<div class="admin-index">
    <div class="container">
        <div class="row">
            <?=
                \common\widgets\CRUDMenuWidget::widget([
                    'list'     => $model->getAllTables(),
                    'links'    => $model::LINKS,
                    'nameLink' => $model::TABLE_NAMES,
                    'title'    => ['name' => 'Список таблиц', 'options' => ['class' => 'mb-4']],
                ])
            ?>
        </div>
    </div>
</div>
