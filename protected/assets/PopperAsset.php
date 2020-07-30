<?php

namespace app\assets;

use yii\web\AssetBundle;

class PopperAsset extends AssetBundle
{
    public $sourcePath = '@bower/popper.js/src';

    public $js = [
        'popper.js',
    ];

    public $depends = [
        AnimateCssAsset::class,
    ];
}
