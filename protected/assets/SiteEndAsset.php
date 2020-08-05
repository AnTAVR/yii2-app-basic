<?php

namespace app\assets;

use yii\web\AssetBundle;

class SiteEndAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/site';
    public $depends = [
        SiteBeginAsset::class,
        AppEndAsset::class,
    ];
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/site.js',
    ];
}
