<?php

namespace app\modules\account\components;

use Yii;

class TokenType
{
    public const API_AUTH = 0;
    public const CONFIRM_EMAIL = 2;
    public const RECOVERY_PASSWORD = 4;

    /**
     * @param integer $value
     * @return string|null
     */
    public static function getName($value)
    {
        if (in_array($value, static::getRange(), true)) {
            $statusName = [
                static::API_AUTH => Yii::t('app', 'API_AUTH'),
                static::CONFIRM_EMAIL => Yii::t('app', 'CONFIRM_EMAIL'),
                static::RECOVERY_PASSWORD => Yii::t('app', 'RECOVERY_PASSWORD'),
            ];
            return $statusName[$value];
        }
        return null;
    }

    /**
     * @return int[]
     */
    public static function getRange()
    {
        return [static::API_AUTH, static::CONFIRM_EMAIL, static::RECOVERY_PASSWORD];
    }
}
