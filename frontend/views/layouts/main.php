<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
//            'renderInnerContainer' => false,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Портфолио', 'url' => ['/students']],
        ['label' => 'Документы', 'url' => ['/documents/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);?>
    <?php if(!Yii::$app->user->isGuest) { ?>
    <div class="dropdown pmd-dropdown pmd-user-info" style="margin-left: 5%;">
        <a href="javascript:void(0);" class="btn-user dropdown-toggle media align-items-center" style="text-decoration: none; color: inherit;" data-toggle="dropdown" data-sidebar="true" aria-expanded="false">
            <img class="profile-avatar mr-2" src="<?= \common\models\storage\Storage::getFileUrl(!empty(Yii::$app->user->identity->photo) ? Yii::$app->user->identity->photo : \common\models\User::DEFAULT_USER_IMAGE) ?>" width="40" height="40" alt="avatar">
            <div class="media-body">
                <?= Yii::$app->user->identity->getUserInitials() ?>
            </div>
            <i class="material-icons md-light ml-2 pmd-sm"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <a class="dropdown-item" href="/profile">Профиль</a>
            <?php if(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id)['Студент']) {
                $s_id = \common\models\Students::find()->select('id')->where(['user_id' => Yii::$app->user->id])->asArray()->one();
                echo Html::a('Портфолио', ['students/student', 'id' => $s_id['id']], ['class' => 'dropdown-item']);
            } ?>
            <?=
             Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton('Выйти', ['class' => 'dropdown-item', 'style' => 'margin: -1px 0;'])
            . Html::endForm() ?>
        </ul>
    </div>
    <?php } ?>

    <?php NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="page-footer font-small bg-dark pt-4 mt-5">

    <!-- Footer Elements -->
    <div class="container">
        <!-- Social buttons -->
        <ul class="list-unstyled list-inline text-center text-white">
            <li class="list-inline-item">
                <a class="btn-floating btn-fb mx-1">
                    <i class="fab fa-facebook"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-gplus mx-1">
                    <i class="fab fa-vk"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-li mx-1">
                    <i class="fab fa-discord"> </i>
                </a>
            </li>
        </ul>
        <!-- Social buttons -->

    </div>
    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center text-white py-3">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></div>
    <!-- Copyright -->

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
