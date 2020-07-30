<?php

namespace app\modules\articles\traits;

use Yii;

trait ArticlesStatusTrait
{
    /**
     * @return int[]
     */
    public static function getStatusRange(): array
    {
        return [
            IActiveArticlesStatus::DELETED,
            IActiveArticlesStatus::DRAFT,
            IActiveArticlesStatus::ACTIVE,
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
            IActiveArticlesStatus::DELETED => Yii::t('app', 'DELETED'),
            IActiveArticlesStatus::DRAFT => Yii::t('app', 'DRAFT'),
            IActiveArticlesStatus::ACTIVE => Yii::t('app', 'ACTIVE')
        ];
    }
}

interface IActiveArticlesStatus
{
    public const DELETED = 0;
    public const DRAFT = 10;
    public const ACTIVE = 20;
}
