<?php

use borales\extensions\phoneInput\PhoneInputAsset;
use kartik\editors\assets\CodemirrorAsset;
use kartik\editors\assets\CodemirrorFormatterAsset;
use kartik\editors\assets\SummernoteAsset;
use kartik\icons\FontAwesomeAsset;
use kv4nt\owlcarousel\OwlCarouselAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\JqueryAsset;

return [
    'appendTimestamp' => true,
    'forceCopy' => YII_ENV_DEV,
    'bundles' => [
        JqueryAsset::class => [
            'js' => [
                YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
            ],
        ],
        BootstrapAsset::class => [
            'css' => [
                YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
            ],
        ],
        BootstrapPluginAsset::class => [
            'js' => [
                YII_ENV_DEV ? 'js/bootstrap.bundle.js' : 'js/bootstrap.bundle.min.js',
            ],
        ],
        FontAwesomeAsset::class => [
//            'baseUrl' => '//use.fontawesome.com/releases/v5.14.0',
            'sourcePath' => '@bower/fontawesome',
            'publishOptions' => [
                'only' => [
                    'css/*',
                    'js/*',
                    'webfonts/*',
                ]
            ],
            'js' => [
//                YII_ENV_DEV ? 'js/all.js' : 'js/all.min.js',
            ],
            'css' => [
                YII_ENV_DEV ? 'css/all.css' : 'css/all.min.css',
            ],
        ],
        SummernoteAsset::class => [
//            'baseUrl' => '//cdn.jsdelivr.net/npm/summernote@0.8.18/dist',
            'sourcePath' => '@bower/summernote/dist',
            'js' => [
                YII_ENV_DEV ? 'summernote-bs4.js' : 'summernote-bs4.min.js',
            ],
            'css' => [
                YII_ENV_DEV ? 'summernote-bs4.css' : 'summernote-bs4.min.css',
            ],
        ],
        CodemirrorAsset::class => [
//            'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.55.0',
            'sourcePath' => '@bower/codemirror',
            'publishOptions' => [
                'only' => [
                    'lib/*',
                    'addon/*',
                    'addon/*/*',
                    'mode/*',
                    'mode/*/*',
                    'theme/*',
                    'keymap/*',
                ],
            ],
            'js' => [
                'lib/codemirror.js',
            ],
            'css' => [
                'lib/codemirror.css',
            ],
        ],
        CodemirrorFormatterAsset::class => [
//            'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/codemirror/2.38.0',
            'sourcePath' => '@npm/codemirror/lib/util',
        ],
        PhoneInputAsset::class => [
//            'baseUrl' => '//cdnjs.cloudflare.com/ajax/libs/codemirror/2.38.0',
            'sourcePath' => '@bower/intl-tel-input/build',
            'js' => [
                'js/utils.js',
                'js/intlTelInput-jquery.js',
            ],
            'css' => [
                'css/intlTelInput.css',
            ],
        ],
        OwlCarouselAsset::class => [
            'sourcePath' => '@bower/owl.carousel/dist',
            'js' => [
                YII_ENV_DEV ? 'owl.carousel.js' : 'owl.carousel.min.js',
            ],
            'css' => [
                YII_ENV_DEV ? 'assets/owl.carousel.css' : 'assets/owl.carousel.min.css',
                YII_ENV_DEV ? 'assets/owl.theme.default.css' : 'assets/owl.theme.default.min.css',
            ],
        ],
    ],
];
