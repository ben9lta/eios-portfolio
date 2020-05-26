<?php
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $tables Query */

$this->title = 'Административная часть';
?>
<div class="admin-index">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card-counter primary">
                    <i class="fa fa-user"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['user']['count'] ?></span>
                    <span class="count-name">Пользователи</span>
                    <a class="card-url" href="/users/index"></a>
                </div>

            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter primary">
                    <i class="fa fa-child"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['students']['count'] ?></span>
                    <span class="count-name">Студенты</span>
                    <a class="card-url" href="/students/index"></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter primary">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['group']['count'] ?></span>
                    <span class="count-name">Группы</span>
                    <a class="card-url" href="/group/index"></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter info">
                    <i class="fa fa-check-circle"></i>
                    <span class="count-numbers">RBAC</span>
                    <span class="count-name">РОЛИ</span>
                    <a class="card-url" href="/rbac"></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter success">
                    <i class="fa fa-trophy"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['achievements']['count'] ?></span>
                    <span class="count-name">Достижения</span>
                    <a class="card-url" href="/achievements/index"></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter success">
                    <i class="fa fa-comments"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['conferences']['count'] ?></span>
                    <span class="count-name">Конференции</span>
                    <a class="card-url" href="/conferences/index"></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter success">
                    <i class="fa fa-folder"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['courseworks']['count'] ?></span>
                    <span class="count-name">Курсовые работы</span>
                    <a class="card-url" href="/courseworks/index"></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter success">
                    <i class="fa fa-folder"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['vkr']['count'] ?></span>
                    <span class="count-name">ВКР</span>
                    <a class="card-url" href="/vkr/index"></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-counter success">
                    <i class="fa fa-folder"></i>
                    <span class="count-numbers">Кол-во: <?= $tables['practics']['count'] ?></span>
                    <span class="count-name">Практики</span>
                    <a class="card-url" href="/practics/index"></a>
                </div>
            </div>

        </div>
    </div>
</div>
