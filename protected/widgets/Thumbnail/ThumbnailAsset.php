<?php

namespace app\widgets\Thumbnail;

use yii\bootstrap4\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class ThumbnailAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/Thumbnail/assets';

    public $js = [
        'thumbnail.js',
    ];

    public $css = [
        'thumbnail.css',
    ];

    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
    ];
}
