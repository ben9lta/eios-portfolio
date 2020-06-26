<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $prProvider yii\data\ActiveDataProvider */
/* @var $vkrProvider yii\data\ActiveDataProvider */
/* @var $cwProvider yii\data\ActiveDataProvider */
/* @var $evProvider yii\data\ActiveDataProvider */
/* @var $pbProvider yii\data\ActiveDataProvider */
/* @var $achProvider yii\data\ActiveDataProvider */


$this->title = $model->user->fullname;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => Url::to(['students/student', 'id' => $model->id])];
\yii\web\YiiAsset::register($this);
?>
<div class="students-view">

    <div class="row">
        <!-- Фотография -->
        <div class="mx-auto col-lg-3">
            <figure class="figure">
                <?= Html::img($model->user->getUserPhoto(), ['alt' => $this->title, 'class' => 'figure-img img-fluid rounded profile-photo']); ?>
                <?= Yii::$app->user->id === $model->user_id ? Html::a('Редактировать', Url::to(['site/profile']), ['class' => 'btn btn-success w-100']) : ''; ?>
                <figcaption class="figure-caption">Последнее обновление: <?= date('d.m.Y', $model->user->updated_at) ?></figcaption>
            </figure>
        </div>
        <!-- Информация о студенте -->
        <div class="col-lg-9">
            <div class="profile-head">
                <?= Html::tag('h5', Html::encode($this->title)); ?>
                <p>
                    Студент<?= $model->user->gender == 0 ? ', ' : 'ка, ' ?>
                    <?= $model->group->course ?> курс. <?= $model->group->dir->code ?> <?= $model->group->dir->title ?>.
                </p>
                <div class="col-lg-8 pl-0 mt-3">

                    <!-- <h4 class="mb-4">Личная информация</h4> -->
                    <table class="table table-sm table-responsive-md">
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
                        <tr>
                            <td class="active">Учебная деятельность</td>
                            <td><?= Html::a('Посмотреть', Url::to(['students/edu', 'id' => $model->id])) ?></td>
                        </tr>
                        <tr>
                            <td class="active">Научная деятельность</td>
                            <td><?= Html::a('Посмотреть', Url::to(['students/science', 'id' => $model->id])) ?></td>
                        </tr>
                        <tr>
                            <td class="active">Достижения</td>
                            <td><?= Html::a('Посмотреть', Url::to(['students/achievements', 'id' => $model->id])) ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <?php
        switch(Yii::$app->controller->action->id) {
            case 'edu':
                echo $this->render('section/edu.php', [
                    'model' => $model,
                    'vkrProvider' => $vkrProvider,
                    'cwProvider' => $cwProvider,
                    'prProvider' => $prProvider,
                ]);
                break;
            case 'science':
                echo $this->render('section/science.php', [
                    'model' => $model,
                    'evProvider' => $evProvider,
                    'pbProvider' => $pbProvider,
                ]);
                break;
            case 'achievements':
                echo $this->render('section/achievements.php', [
                    'model' => $model,
                    'achProvider' => $achProvider,
                ]);
                break;
            default:
                echo $this->render('section/main.php', [
                    'model' => $model,
                ]);
                break;
        }
    ?>
    <hr/>
</div>
