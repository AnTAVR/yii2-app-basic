<?php

namespace app\modules\products\components;

use app\modules\products\models\Products;
use app\modules\products\traits\IActiveProductsStatus;
use Yii;

class ProductsItems
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
                'label' => Yii::t('app', 'Products'),
                'active' => $moduleId === 'products',
                'url' => ['/products'],
                'items' => $items,
            ];
        }
        return $itemsMenu;
    }

    /**
     * @param array $order
     * @return Products[]
     */
    protected static function findModel($order): array
    {
        return Products::find()
            ->where(['status' => IActiveProductsStatus::ACTIVE])
            ->orderBy($order)
            ->limit(10)->all();
    }
}
