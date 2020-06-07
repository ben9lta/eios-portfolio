    <?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Students */

$this->title = $model->user->fullname;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="students-view">

    <div class="row">
        <!-- Фотография -->
        <div class="mx-auto col-lg-3">
            <figure class="figure">
                <?= Html::img($model->user->getUserPhoto(), ['alt' => $this->title, 'class' => 'figure-img img-fluid rounded profile-photo']); ?>
                <figcaption class="figure-caption">Последнее обновление: <?= date('d.m.Y', $model->user->updated_at) ?></figcaption>
            </figure>
        </div>
        <!-- Информация о студенте -->
        <div class="col-lg-9">
            <div class="profile-head">
                <?= Html::tag('h5', Html::encode($this->title)) ?>
                <p>
                    Студент<?= $model->user->gender == 0 ? ', ' : 'ка, ' ?>
                    <?= $model->group->course ?> курс. <?= $model->group->dir->code ?> <?= $model->group->dir->title ?>.
                </p>
                <div class="col-lg-8 pl-0 mt-3">

                    <!-- <h4 class="mb-4">Личная информация</h4> -->
                    <table class="table table-sm">
                        <tbody>
                        <tr>
                            <td class="active">Дата рождения</td>
                            <td><?= $model->user->birthday ?? 'Не указано' ?></td>
                        </tr>
                        <tr>
                            <td class="active">Телефон</td>
                            <td><?= $model->user->phone ?? 'Не указано' ?></td>
                        </tr>
                        <tr>
                            <td class="active">Email</td>
                            <td><?= $model->user->email ?? 'Не указано' ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <!-- Блок "Образование" -->
    <div class="row mr-0">
        <div class="profile-education ml-3 w-100">
            <div class="study-head">
                <h4 class="mb-4 alert alert-warning">Образование</h4>
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
    <hr/>
</div>
