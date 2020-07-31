<?php

namespace app\assets;

use yii\web\AssetBundle;

class SiteBeginAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/site';
    public $depends = [
        AppBeginAsset::class
    ];
    public $css = [
        'css/preloader.css',
    ];
    public $js = [
        'js/preloader.js',
    ];
}
