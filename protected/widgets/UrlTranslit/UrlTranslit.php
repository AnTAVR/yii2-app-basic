<?php

namespace app\widgets\UrlTranslit;

use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class UrlTranslit extends InputWidget
{
    public const PATTERN = '/^[a-z0-9\-]*$/s';
    public const HINT = 'a-z 0-9 -';

    public $dictTranslate = [
        ['а', 'a'], ['б', 'b'], ['в', 'v'], ['г', 'g'],
        ['д', 'd'], ['е', 'e'], ['ё', 'yo'], ['ж', 'zh'],
        ['з', 'z'], ['и', 'i'], ['й', 'y'], ['к', 'k'],
        ['л', 'l'], ['м', 'm'], ['н', 'n'], ['о', 'o'],
        ['п', 'p'], ['р', 'r'], ['с', 's'], ['т', 't'],
        ['у', 'u'], ['ф', 'f'], ['х', 'h'], ['ц', 'c'],
        ['ч', 'ch'], ['ш', 'sh'], ['щ', 'sch'], ['ъ', ''],
        ['ы', 'y'], ['ь', ''], ['э', 'e'], ['ю', 'yu'],
        ['я', 'ya'], ['і', 'i'], ['є', 'je'], ['ї', 'ji'],
        ['ґ', 'g']
    ];
    public $fromField;
    public $template = '{icon}{input}';
    public $icon = 'link';
    public $clientOptions = [];
    public $enable = true;
    public $class_enable = 'text-info';
    public $class_disable = 'text-danger';

    public function init(): void
    {
        parent::init();
        $dictTranslate = Json::encode($this->dictTranslate);
        $this->view->registerJs(<<<JS
$().UrlTranslit.defaults.dictTranslate = $dictTranslate;
$().UrlTranslit.defaults.class_enable = '$this->class_enable';
$().UrlTranslit.defaults.class_disable = '$this->class_disable';
JS
        );
    }

    public function run()
    {
        if (!isset($this->options['class'])) {
            $this->options['class'] = 'form-control';
        }
        $iconId = 'icon-' . $this->options['id'];

        if (!isset($this->options['aria-describedby'])) {
            $this->options['aria-describedby'] = $iconId;
        }

        if ($this->hasModel()) {
            $replace['{input}'] = Html::activeTextInput($this->model, $this->attribute, $this->options);
            $value = Html::getAttributeValue($this->model, $this->attribute);
            $icon_class = ($value ? $this->class_disable : $this->class_enable);
        } else {
            $replace['{input}'] = Html::textInput($this->name, $this->value, $this->options);
            $icon_class = ($this->value ? $this->class_disable : $this->class_enable);
        }

        if ($this->icon !== '') {
            $icon = Html::tag('span', Icon::show($this->icon), ['class' => 'input-group-text btn ' . $icon_class, 'id' => $iconId]);
            $replace['{icon}'] = Html::tag('div', $icon, ['class' => 'input-group-prepend']);
        }

        echo Html::tag('div', strtr($this->template, $replace), ['class' => 'input-group']);

        $this->registerClientScript();
    }

    public function registerClientScript(): void
    {
        UrlTranslitAsset::register($this->view);

        if ($this->icon !== '') {
            Icon::map($this->view);
        }

        $selectorId = $this->hasModel() ? Html::getInputId($this->model, $this->fromField) : $this->fromField;
        $selector = "jQuery('#$selectorId')";
        $this->clientOptions['destination'] = $this->options['id'];

        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        $this->view->registerJs("$selector.UrlTranslit($options);");

        $iconId = 'icon-' . $this->options['id'];
        $selector = "jQuery('#$iconId')";

        $this->view->registerJs("$selector.on('click', $().UrlTranslit.onclick);");
    }
}
