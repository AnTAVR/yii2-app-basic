<?php

namespace app\assets;

use yii\web\AssetBundle;

class SiteAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/site';
    public $css = [
        'css/preloader.css',
        'css/site.css',
    ];
    public $js = [
        'js/preloader.js',
        'js/site.js',
    ];
    public $depends = [
        AppAsset::class
    ];
}
