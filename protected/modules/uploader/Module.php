<?php

namespace app\modules\uploader;

use app\components\Module as BaseModule;

class Module extends BaseModule
{
    public function init(): void
    {
        parent::init();

        $this->params = require __DIR__ . '/config/params.php';
    }
}
