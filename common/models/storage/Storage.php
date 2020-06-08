<?php
namespace common\models\storage;

use Yii;
use yii\helpers\Url;

class Storage
{
    public static function getStoragePath() {
        return Yii::getAlias('@storage/');
    }
    public static function randomFileName($file)
    {
        return uniqid() . '.' . $file->extension; //QW52ASDx.jpg
    }

    public static function getFileUrl($file)
    {
        if(empty($file))
        {
            return null;
        }

        $url = Url::base(true); //domain url
        $position = strpos($url, '//') + 2;

        if(basename(Yii::getAlias('@app')) === 'backend') {
            $domain = array_shift(explode('.', $_SERVER['HTTP_HOST']));
            $storageUrl = substr($url, 0, $position) . 'storage.' . substr($url, $position + strlen($domain) + 1);
        }
        else
            $storageUrl = substr($url, 0, $position) . 'storage.' . $_SERVER['HTTP_HOST'];

        return $storageUrl . '/'. $file;
    }
}