<?php

namespace app\modules\account\components;

use Yii;

class UserStatus
{
    public const INACTIVE = 0;
    public const ACTIVE = 10;
    public const BLOCKED = 20;
    public const DELETED = 30;

    /**
     * @param integer $value
     * @return string|null
     */
    public static function getName($value)
    {
        if (in_array($value, static::getRange(), true)) {
            $statusName = [
                static::INACTIVE => Yii::t('app', 'ACTIVE'),
                static::ACTIVE => Yii::t('app', 'ACTIVE'),
                static::BLOCKED => Yii::t('app', 'BLOCKED'),
                static::DELETED => Yii::t('app', 'DELETED'),
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
        return [static::INACTIVE, static::ACTIVE, static::BLOCKED, static::DELETED];
    }
}
