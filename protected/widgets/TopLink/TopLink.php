<?php

namespace app\widgets\TopLink;

use kartik\icons\Icon;
use Yii;
use yii\base\Widget;
use yii\bootstrap4\Html;

class TopLink extends Widget
{
    public $idw = 'toplink';
    public $icon = 'chevron-up';
    public $text;
    public $echoText = false;

    public function init(): void
    {
        parent::init();

        if (empty($this->text)) {
            $this->text = Yii::t('app', 'Up');
        }
        $this->registerClientScript();
    }

    public function registerClientScript(): void
    {
        TopLinkAsset::register($this->view);
    }

    public function run(): string
    {
        $text = '';
        if ($this->echoText) {
            $text = $this->text;
        }
        $icon = Icon::show($this->icon);
        return HTML::tag('div', $icon . $text, [
            'id' => $this->idw,
            'class' => 'btn btn-outline-info btn-lg',
            'title' => $this->text,
        ]);
    }
}
