<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminBeginAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/admin';
    public $depends = [
        AppBeginAsset::class
    ];
}
