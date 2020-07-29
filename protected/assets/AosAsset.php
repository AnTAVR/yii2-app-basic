<?php

namespace app\assets;

use yii\web\AssetBundle;

class AosAsset extends AssetBundle
{
    public $sourcePath = '@bower/aos/dist';
    public $css = [
        'aos.css',
    ];
    public $js = [
        'aos.js',
    ];
}
