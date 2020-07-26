<?php

namespace app\modules\account;

use app\components\Module as BaseModule;
use Yii;
use yii\base\BootstrapInterface;

class Module extends BaseModule implements BootstrapInterface
{
    public function init()
    {
        parent::init();

        $this->params = require __DIR__ . '/config/params.php';

        Yii::$app->urlManager->addRules(
            [
                '/account' => '/account/default/index',
            ]
        );
    }

    public function bootstrap($app)
    {
    }
}
