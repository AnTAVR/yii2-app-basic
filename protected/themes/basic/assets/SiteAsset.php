<?php

namespace app\themes\basic\assets;

use app\assets\AppAsset;
use app\themes\BasicTheme as Theme;
use yii\web\AssetBundle;

class SiteAsset extends AssetBundle
{
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/site.js',
    ];
    public $depends = [
        AppAsset::class
    ];

    public function init()
    {
        parent::init();
        $theme = new Theme;
        $this->sourcePath = $theme->basePath . '/assets/app';
    }
}
