<?php

namespace app\modules\articles;

use app\components\Module as BaseModule;
use Yii;

class Module extends BaseModule
{
    public function init(): void
    {
        parent::init();

        $this->params = require __DIR__ . '/config/params.php';

        Yii::$app->urlManager->addRules(
            [
                '/articles/page<page:\d+>' => '/articles/default/index',
                '/articles/view/<meta_url:[\w\-]+>' => '/articles/default/view',
            ]
        );
    }
}
