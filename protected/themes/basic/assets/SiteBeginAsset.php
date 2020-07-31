<?php

namespace app\themes\basic\assets;

use app\assets\AppBeginAsset;
use app\themes\BasicTheme as Theme;
use yii\web\AssetBundle;

class SiteBeginAsset extends AssetBundle
{
    public $depends = [
        AppBeginAsset::class
    ];

    public function init(): void
    {
        parent::init();
        $theme = new Theme;
        $this->sourcePath = $theme->basePath . '/assets/site';
    }
}
