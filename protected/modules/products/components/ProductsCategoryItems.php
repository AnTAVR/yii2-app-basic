<?php

namespace app\modules\products\components;

use app\modules\products\models\Category;

class ProductsCategoryItems
{
    public static function items($type): array
    {
        $items = [];
        foreach (static::findModel($type) as $model) {
            $item = [];
            foreach ($model->products as $product) {
                $item[] = ['label' => $product->content_title, 'url' => $product->arrUrl];
            }
            $items[] = ['label' => $model->content_title, 'url' => $model->arrUrl, 'items' => $item];
        }

        return $items;
    }

    /**
     * @param int $type
     * @return Category[]
     */
    protected static function findModel($type): array
    {
        return Category::find()
            ->where(['type' => $type])
            ->orderBy(['published_at' => SORT_DESC, 'id' => SORT_ASC])
            ->all();
    }
}
