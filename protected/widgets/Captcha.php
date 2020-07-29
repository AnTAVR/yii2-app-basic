<?php

namespace app\widgets;

use Yii;
use yii\bootstrap4\Html;
use yii\captcha\Captcha as BaseCaptcha;

class Captcha extends BaseCaptcha
{
    public $template = '<div class="input-group"><div class="input-group-prepend">{image}</div>{input}</div>';
    public $imageOptions = ['style' => 'cursor: pointer;'];
    public $captchaAction = '/site/captcha';

    public function init(): void
    {
        if (!isset($this->imageOptions['title'])) {
            $this->imageOptions['title'] = Yii::t('app', 'Get new code');
        }
        if (!isset($this->options['value'])) {
            $this->options['value'] = YII_ENV_TEST || YII_ENV_DEV ? 'testme' : '';
        }

        if (array_key_exists('class', $this->options)) {
            Html::addCssClass($this->options, 'col-3');
        }
        parent::init();
    }
}
