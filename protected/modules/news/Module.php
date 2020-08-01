<?php

namespace app\modules\news;

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
                '/news/page<page:\d+>' => '/news/default/index',
                '/news/view/<meta_url:[\w\-]+>' => '/news/default/view',
            ]
        );
    }
}
