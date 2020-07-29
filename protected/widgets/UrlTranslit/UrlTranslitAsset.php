<?php

namespace app\widgets\UrlTranslit;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class UrlTranslitAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/UrlTranslit/assets';

    public $js = [
        'jquery.url-translit.js',
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}
