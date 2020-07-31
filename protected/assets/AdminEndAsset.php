<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminEndAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/admin';
    public $depends = [
        AdminBeginAsset::class,
        AppEndAsset::class,
    ];
    public $css = [
        'css/admin.css',
    ];
    public $js = [
        'js/admin.js',
    ];
}
