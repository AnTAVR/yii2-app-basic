<?php

namespace app\widgets\LinkPager;

use yii\bootstrap4\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class LinkPagerAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/LinkPager/assets';

    public $js = [
        'jquery.linkpager.js',
    ];

    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
    ];
}
