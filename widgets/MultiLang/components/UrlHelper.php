<?php


namespace app\widgets\MultiLang\components;


use Yii;
use yii\helpers\VarDumper;

class UrlHelper
{
    const UZ = 'uz';
    const RU = 'ru';
    const EN = 'en';

    public static function createLocalizedUrl($language)
    {
        $host = Yii::$app->request->hostInfo;
        $url = Yii::$app->request->url;
        $arrays = explode('/', $url);
        $newUrl = [];

        if(!empty($arrays)){
            foreach ($arrays as $key => $array) {
                if(
                    ($key == 1 && $array === self::UZ) ||
                    ($key == 1 && $array === self::RU) ||
                    ($key == 1 && $array === self::EN)
                )
                {
                    $array = $language;
                }
                $newUrl[] = $array;
            }
            $newUrlStr = implode('/', $newUrl);

        }
        return $host . $newUrlStr;
    }
}