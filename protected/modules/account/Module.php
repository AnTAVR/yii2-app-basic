<?php

namespace app\modules\account;

use app\components\Module as BaseModule;
use app\modules\account\events\AfterLoginEvent;
use app\modules\account\events\AfterLogoutEvent;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\web\User;

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
        if ($app instanceof Application) {
            $app->user->on(User::EVENT_AFTER_LOGIN, [AfterLoginEvent::class, 'run']);
            $app->user->on(User::EVENT_AFTER_LOGOUT, [AfterLogoutEvent::class, 'run']);
        }
    }
}
