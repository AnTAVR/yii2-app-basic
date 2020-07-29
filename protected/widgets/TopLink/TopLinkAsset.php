<?php

namespace app\widgets\TopLink;

use yii\bootstrap4\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class TopLinkAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/TopLink/assets';

    public $css = [
        'toplink.css',
    ];

    public $js = [
        'toplink.js',
    ];

    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
    ];
}