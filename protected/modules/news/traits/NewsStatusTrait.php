<?php

namespace app\modules\news\traits;

use Yii;

trait NewsStatusTrait
{
    /**
     * @return int[]
     */
    public static function getStatusRange(): array
    {
        return [
            IActiveNewsStatus::DELETED,
            IActiveNewsStatus::DRAFT,
            IActiveNewsStatus::ACTIVE,
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
            IActiveNewsStatus::DELETED => Yii::t('app', 'DELETED'),
            IActiveNewsStatus::DRAFT => Yii::t('app', 'DRAFT'),
            IActiveNewsStatus::ACTIVE => Yii::t('app', 'ACTIVE')
        ];
    }
}

interface IActiveNewsStatus
{
    public const DELETED = 0;
    public const DRAFT = 10;
    public const ACTIVE = 20;
}
