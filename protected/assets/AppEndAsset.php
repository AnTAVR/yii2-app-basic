<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppEndAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/app';
    public $depends = [
        AppBeginAsset::class,
    ];
    public $css = [
        'css/app.css',
    ];
    public $js = [
        'js/app.js',
    ];
}
