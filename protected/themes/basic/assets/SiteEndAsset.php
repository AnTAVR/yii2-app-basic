<?php

namespace app\themes\basic\assets;

use app\assets\AppEndAsset;
use app\themes\BasicTheme as Theme;
use yii\web\AssetBundle;

class SiteEndAsset extends AssetBundle
{
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

    public function init(): void
    {
        parent::init();
        $theme = new Theme;
        $this->sourcePath = $theme->basePath . '/assets/site';
    }
}
