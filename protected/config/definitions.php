<?php
/** @noinspection ClassConstantCanBeUsedInspection */
return [
    kartik\editors\Summernote::class => [
        'class' => kartik\editors\Summernote::class,
        'autoFormatCode' => true,
        'pluginOptions' => [
            'codemirror' => [
                'mode' => 'text/html',
                'theme' => kartik\editors\Codemirror::DEFAULT_THEME,
                'lineNumbers' => true,
                'styleActiveLine' => true,
                'matchBrackets' => true,
                'smartIndent' => true,
                'matchTags' => [
                    'bothTags' => true,
                ],
            ],
        ],
    ],
];
