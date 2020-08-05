<?php

namespace app\modules\products\traits;

use Yii;

trait ProductsStatusTrait
{
    /**
     * @return int[]
     */
    public static function getStatusRange(): array
    {
        return [
            IActiveProductsStatus::DELETED,
            IActiveProductsStatus::DRAFT,
            IActiveProductsStatus::ACTIVE,
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
            IActiveProductsStatus::DELETED => Yii::t('app', 'DELETED'),
            IActiveProductsStatus::DRAFT => Yii::t('app', 'DRAFT'),
            IActiveProductsStatus::ACTIVE => Yii::t('app', 'ACTIVE')
        ];
    }
}

interface IActiveProductsStatus
{
    public const DELETED = 0;
    public const DRAFT = 10;
    public const ACTIVE = 20;
}
