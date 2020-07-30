<?php

namespace app\modules\articles\components;

use app\modules\articles\models\Articles;
use app\modules\articles\traits\IActiveArticlesStatus;
use Yii;

class ArticlesItems
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
                'label' => Yii::t('app', 'Articles'),
                'active' => $moduleId === 'articles',
                'url' => ['/articles'],
                'items' => $items,
            ];
        }
        return $itemsMenu;
    }

    /**
     * @param array $order
     * @return Articles[]
     */
    protected static function findModel($order): array
    {
        return Articles::find()
            ->where(['status' => IActiveArticlesStatus::ACTIVE])
            ->orderBy($order)
            ->limit(10)->all();
    }
}
