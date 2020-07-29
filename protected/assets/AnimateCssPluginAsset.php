<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AnimateCssPluginAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/animate_css';

    public $js = [
        'animation.js'
    ];

    public $depends = [
        JqueryAsset::class,
        AnimateCssAsset::class,
    ];
}
