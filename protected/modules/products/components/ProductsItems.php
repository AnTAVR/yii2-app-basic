<?php

namespace app\modules\products\components;

use app\modules\products\models\Products;
use app\modules\products\traits\IActiveProductsStatus;
use Yii;

class ProductsItems
{
    public static function items($order, $category_id = null): array
    {
        $moduleId = Yii::$app->controller->module->id;
        $title = null;
        $itemsMenu = [];
        $items = [];
        foreach (static::findModel($order, $category_id) as $model) {
            if ($category_id !== null && $title === null) {
                $title = $model->category->content_title;
            }
            $items[] = ['label' => $model->content_title, 'url' => $model->arrUrl];
        }

        if ($title === null) {
            $title = Yii::t('app', 'Products');
        }
        if ($items) {
            $itemsMenu = [
                'label' => $title,
                'active' => $moduleId === 'products',
                'url' => ['/products'],
                'items' => $items,
            ];
        }
        return $itemsMenu;
    }

    /**
     * @param array $order
     * @param null $category_id
     * @return Products[]
     */
    protected static function findModel($order, $category_id = null): array
    {
        if ($category_id === null) {
            return Products::find()
                ->where(['status' => IActiveProductsStatus::ACTIVE])
                ->orderBy($order)
                ->limit(10)->all();
        }

        return Products::find()
            ->where(['status' => IActiveProductsStatus::ACTIVE, 'category_id' => $category_id])
            ->orderBy($order)
            ->limit(10)->all();
    }
}
