<?php

namespace app\modules\news\components;

use app\modules\news\models\News;
use app\modules\news\traits\IActiveNewsStatus;
use Yii;

class NewsItems
{
    public static function items($order): array
    {
        $moduleId = Yii::$app->controller->module->id;

        $itemsMenu = [];
        $items = [];
        foreach (static::findModel($order) as $model) {
            $items[] = ['label' => $model->content_title, 'url' => $model->arrUrl];
        }
        if ($items) {
            $itemsMenu = [
                'label' => Yii::t('app', 'News'),
                'active' => $moduleId === 'news',
                'url' => ['/news'],
                'items' => $items,
            ];
        }
        return $itemsMenu;
    }

    /**
     * @param array $order
     * @return News[]
     */
    protected static function findModel($order): array
    {
        return News::find()
            ->where(['status' => IActiveNewsStatus::ACTIVE])
            ->orderBy($order)
            ->limit(10)->all();
    }
}
