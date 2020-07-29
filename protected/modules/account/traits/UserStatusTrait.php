<?php

namespace app\modules\account\traits;

use Yii;

trait UserStatusTrait
{
    /**
     * @return int[]
     */
    public static function getStatusRange(): array
    {
        return [
            IActiveUserStatus::INACTIVE,
            IActiveUserStatus::ACTIVE,
            IActiveUserStatus::BLOCKED,
            IActiveUserStatus::DELETED,
        ];
    }

    /**
     * @param string $nullLabel
     * @return string
     */
    public function getStatus($nullLabel = ''): string
    {
        $statuses = static::getStatusList();
        return (isset($this->status, $statuses[$this->status])) ? $statuses[$this->status] : $nullLabel;
    }

    /**
     * @return array
     */
    public static function getStatusList(): array
    {
        return [
            IActiveUserStatus::INACTIVE => Yii::t('app', 'INACTIVE'),
            IActiveUserStatus::ACTIVE => Yii::t('app', 'ACTIVE'),
            IActiveUserStatus::BLOCKED => Yii::t('app', 'BLOCKED'),
            IActiveUserStatus::DELETED => Yii::t('app', 'DELETED'),
        ];
    }
}

interface IActiveUserStatus
{
    public const INACTIVE = 0;
    public const ACTIVE = 10;
    public const BLOCKED = 20;
    public const DELETED = 30;
}
