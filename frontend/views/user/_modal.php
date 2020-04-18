<?php

use yii\bootstrap4\Modal;
/** @var string $policy */

Modal::begin([
'title' => 'ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ',
'size' => 'modal-lg',
'toggleButton' => [
    'label' => 'обработку персональных данных.',
    'tag' => 'a',
    'class' => 'color-red',
],
'footer' => Yii::$app->name,
]);


echo $policy;

Modal::end();
?>