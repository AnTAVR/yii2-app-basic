<?php

namespace app\widgets\LinkPager;

use Exception;
use Yii;
use yii\bootstrap4\Button;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager as BaseLinkPager;
use yii\helpers\ArrayHelper;

class LinkPager extends BaseLinkPager
{
    public $jumpPageLabel = false;
    public $jumpPageCssClass = 'jump';
    public $btnJumpPageCssClass = 'btn btn-outline-info btn-sm';
    public $textJumpPageCssClass = 'form-control';
    public $jumpPageReplace = '{page_num}';
    public $options = ['class' => ['pagination-sm']];

    public function init()
    {
        parent::init();

        $this->registerClientScript();
        if (array_key_exists('class', $this->listOptions)) {
            Html::addCssClass($this->options, $this->listOptions['class']);
        }
    }

    public function registerClientScript()
    {
        LinkPagerAsset::register($this->view);

        $tmpPage = 99989929799;
        $url = $this->pagination->createUrl($tmpPage - 1, null, true);
        $url = strrev(implode(strrev($this->jumpPageReplace), explode(strrev($tmpPage), strrev($url), 2)));

        $this->view->registerJs('$().LinkPager.url = "' . $url . '";');
        $this->view->registerJs('$().LinkPager.jumpPageReplace = "' . $this->jumpPageReplace . '";');
    }

    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $firstPageLabel,
                0,
                $this->firstPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton(
                $this->prevPageLabel,
                $page,
                $this->prevPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        // internal pages
        [$beginPage, $endPage] = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton(
                $i + 1,
                $i,
                null,
                $this->disableCurrentPageButton && $i === $currentPage,
                $i === $currentPage
            );
        }

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton(
                $this->nextPageLabel,
                $page,
                $this->nextPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $lastPageLabel,
                $pageCount - 1,
                $this->lastPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        $jumpPageLabel = $this->jumpPageLabel === true
            ? Yii::t('app', 'Jump to:') : $this->jumpPageLabel;
        if (($jumpPageLabel !== false) && $pageCount > $this->maxButtonCount * 2) {
            $buttons[] = $this->renderJumpPage(
                $jumpPageLabel,
                $currentPage + 1,
                $this->jumpPageCssClass
            );
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'ul');
        return Html::tag($tag, implode("\n", $buttons), $options);
    }

    /**
     * @param string $label the text label
     * @param int $page the page number
     * @param string $class the CSS class for the page button.
     * @return string the rendering result
     * @throws Exception
     */
    protected function renderJumpPage($label, $page, $class)
    {
        $options = $this->linkContainerOptions;
        $linkWrapTag = ArrayHelper::remove($options, 'tag', 'li');
        Html::addCssClass($options, empty($class) ? $this->pageCssClass : $class);

        $input = Html::textInput(null, $page, [
            'size' => '3',
            'maxlength' => '6',
            'options' => ['class' => $this->textJumpPageCssClass],
            'onkeydown' => '$().LinkPager.onkeydown(this, event);'
        ]);

        $button = Button::widget([
            'label' => $label,
            'options' => ['class' => $this->btnJumpPageCssClass, 'onclick' => '$().LinkPager.onclick(this);'],
        ]);

        $item = Html::tag('div', $button . $input, ['class' => 'input-group-append']);
        return Html::tag($linkWrapTag, $item, $options);
    }
}
