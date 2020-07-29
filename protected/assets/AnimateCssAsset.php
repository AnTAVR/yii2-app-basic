<?php

namespace app\assets;

use yii\web\AssetBundle;

class AnimateCssAsset extends AssetBundle
{

    public $sourcePath = '@bower/animate.css';

    public $css = [
        YII_ENV_DEV ? 'animate.css' : 'animate.min.css',
    ];
    public $publishOptions = [
        'only' => [
            'animate.css',
            'animate.min.css',
        ],
    ];
}
