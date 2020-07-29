<?php

namespace app\widgets\Thumbnail;

use Yii;
use yii\base\Widget;

class Thumbnail extends Widget
{
    public $textClose;
    public $textView;

    public function init(): void
    {
        parent::init();

        if (empty($this->textClose)) {
            $this->textClose = Yii::t('app', 'Close');
        }
        if (empty($this->textView)) {
            $this->textView = Yii::t('app', 'View image');
        }

        $this->registerClientScript();
    }

    public function registerClientScript(): void
    {
        ThumbnailAsset::register($this->view);
    }

    public function run(): string
    {
        return <<<HTML5
<div class="modal fade" id="image-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">$this->textView</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="$this->textClose"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <img class="rounded" src="" alt="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">$this->textClose</button>
      </div>
    </div>
  </div>
</div>
HTML5;
    }
}
