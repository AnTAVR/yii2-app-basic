<?php

namespace app\modules\products;

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
                '/products/category/<meta_url:[\w\-]+>/page<page:\d+>' => '/products/category/view',
                '/products/category/<meta_url:[\w\-]+>' => '/products/category/view',
                '/products/category/page<page:\d+>' => '/products/category/index',

                '/products/page<page:\d+>' => '/products/default/index',
                '/products/view/<meta_url:[\w\-]+>' => '/products/default/view',
            ]
        );
    }
}
