<?php

/* @var $this yii\web\View */
/* @var $model common\models\Students */
$this->title = 'Образование';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Блок "Образование" -->
<div class="row mr-0">
    <div class="profile-education ml-3 w-100">
        <div class="study-head">
            <h4 class="mb-4 alert alert-warning"><?= $this->title ?></h4>
        </div>
        <div class="study-info">
            <table class="table-table table-responsive">
                <thead>
                <tr class="table-active">
                    <th class="p-2 pl-4 bg-info vw-100">Текущее</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="bg-light p-4">
                            <p><b>Образовательное учреждение:</b> <?= $model->group->dir->dep->inst->univer->title ?></p>
                            <p class="institute"><b>Институт:</b> <?= $model->group->dir->dep->inst->title ?></p>
                            <p class="specialization"><b>Специальность:</b> <?= $model->group->dir->dep->title ?></p>
                            <p><b>Направление подготовки:</b> <?= $model->group->dir->code ?> <?= $model->group->dir->title ?></p>
                            <p><b>Группа:</b> <?= $model->group->title ?>,  <?= $model->group->form->title ?></p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
