<?php

namespace app\modules\statics;

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
                '/s/<meta_url:[\w\-]+>' => '/statics/default/index',
            ]
        );
    }
}
