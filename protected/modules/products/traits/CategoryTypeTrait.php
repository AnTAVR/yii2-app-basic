<?php

namespace app\modules\products\traits;

use Yii;

trait CategoryTypeTrait
{
    /**
     * @return int[]
     */
    public static function getTypeRange(): array
    {
        return [
            IActiveCategoryType::RIGHT,
            IActiveCategoryType::LEFT,
            IActiveCategoryType::CENTER,
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
            IActiveCategoryType::RIGHT => Yii::t('app', 'RIGHT'),
            IActiveCategoryType::LEFT => Yii::t('app', 'LEFT'),
            IActiveCategoryType::CENTER => Yii::t('app', 'CENTER'),
        ];
    }
}
