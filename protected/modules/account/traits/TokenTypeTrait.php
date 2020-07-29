<?php

namespace app\modules\account\traits;

use Yii;

trait TokenTypeTrait
{
    /**
     * @return int[]
     */
    public static function getTokenRange(): array
    {
        return [
            IActiveTokenType::API_AUTH,
            IActiveTokenType::CONFIRM_EMAIL,
            IActiveTokenType::RECOVERY_PASSWORD,
        ];
    }

    /**
     * @param string $nullLabel
     * @return string
     */
    public function getType($nullLabel = ''): string
    {
        $statuses = static::getTypeList();
        return (isset($this->type, $statuses[$this->type])) ? $statuses[$this->type] : $nullLabel;
    }

    /**
     * @return array
     */
    public static function getTypeList(): array
    {
        return [
            IActiveTokenType::API_AUTH => Yii::t('app', 'API_AUTH'),
            IActiveTokenType::CONFIRM_EMAIL => Yii::t('app', 'CONFIRM_EMAIL'),
            IActiveTokenType::RECOVERY_PASSWORD => Yii::t('app', 'RECOVERY_PASSWORD'),
        ];
    }
}

interface IActiveTokenType
{
    public const API_AUTH = 0;
    public const CONFIRM_EMAIL = 2;
    public const RECOVERY_PASSWORD = 4;
}
