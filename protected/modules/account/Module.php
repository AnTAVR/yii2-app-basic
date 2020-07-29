<?php

namespace app\modules\account;

use app\components\Module as BaseModule;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;

class Module extends BaseModule implements BootstrapInterface
{
    public function init(): void
    {
        parent::init();

        $this->params = require __DIR__ . '/config/params.php';

        Yii::$app->urlManager->addRules(
            [
                '/account' => '/account/default/index',
            ]
        );
    }

    /**
     * @param Application $app
     */
    public function bootstrap($app): void
    {
    }
}
