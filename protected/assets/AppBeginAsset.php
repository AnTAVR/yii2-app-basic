<?php

namespace app\assets;

use kartik\icons\FontAwesomeAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AppBeginAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/app';
    public $depends = [
        YiiAsset::class,
        BootstrapPluginAsset::class,
        FontAwesomeAsset::class,
        AosAsset::class,
        AnimateCssPluginAsset::class,
    ];
}
