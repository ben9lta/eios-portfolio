<?php
namespace common\models\storage;

use Yii;
use yii\helpers\Url;

class Storage
{
    public static function getStoragePath() {
        return Yii::getAlias('@storage');
    }
    public static function randomFileName($file)
    {
        return uniqid() . '.' . $file->extension; //QW52ASDx.jpg
    }

    public static function getFileUrl($file)
    {
        $url = Url::base(true); //domain url
        $position = strpos($url, '//') + 2;

        $storageUrl = substr($url, 0, $position) . 'storage.' . substr($url, $position);

        return $storageUrl . '/'. $file;
    }
}