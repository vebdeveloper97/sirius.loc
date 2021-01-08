<?php
namespace app\widgets\MultiLang;
use app\widgets\MultiLang\components\UrlHelper;
use http\Url;
use yii\helpers\Html;
use Yii;
?>


    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <span class="uppercase"><?=Html::img('/img/flags/'.Yii::$app->language.'.png', ['width'=>'20']) ?><?= '&nbsp;'.strtoupper(Yii::$app->language); ?></span>
            <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="item-lang">
        <li class="item-lang">
            <a href="<?=UrlHelper::createLocalizedUrl('en')?>"><?=Html::img('/img/flags/en.png', ['width'=>'20'])?> EN</a>
        </li>
        <li>
            <a href="<?=UrlHelper::createLocalizedUrl('uz')?>"><?=Html::img('/img/flags/uz.png', ['width'=>'20'])?> UZ</a>
        </li>
        <li class="item-lang">
            <a href="<?=UrlHelper::createLocalizedUrl('ru')?>"><?=Html::img('/img/flags/ru.png', ['width'=>'20'])?> RU</a>
        </li>
    </ul>
