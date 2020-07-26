<?php

namespace app\widgets\TopLink;

use kartik\icons\Icon;
use Yii;
use yii\base\Widget;

class TopLink extends Widget
{
    public $idw = 'toplink';
    public $icon = 'chevron-up';
    public $text;
    public $echoText = false;

    public function init()
    {
        parent::init();

        if (empty($this->text)) {
            $this->text = Yii::t('app', 'Up');
        }
        $this->registerClientScript();
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        TopLinkAsset::register($this->view);
    }

    public function run()
    {
        $text = '';
        if ($this->echoText) {
            $text = $this->text;
        }
        $icon = Icon::show($this->icon);
        return <<<HTML
<div id="$this->idw" class="toplink" title="$this->text">
$icon
$text
</div>
HTML;
    }
}
