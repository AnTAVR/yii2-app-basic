<?php

namespace app\components;

use Yii;
use yii\helpers\FileHelper;
use yii\web\DbSession as BaseSession;

class Session extends BaseSession
{
    public $savePath = '@runtime/session';

    public function setSavePath($value): void
    {
        $path = Yii::getAlias($value);

        if (!is_dir($path)) {
            $dirMode = 0775;
            FileHelper::createDirectory($path, $dirMode, true);
        }

        parent::setSavePath($value);
    }

    protected function composeFields($id = null, $data = null): array
    {
        $fields = parent::composeFields($id, $data);

        $fields['user_id'] = Yii::$app->user->id;

        return $fields;
    }
}
