<?php

namespace app\modules\products\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Database fields:
 * @property int $category_id [int(11)]
 * @property int $product_id [int(11)]
 *
 * Fields:
 */
class Relations extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%products_relations}}';
    }

    public function rules(): array
    {
        return [
            ['category_id', 'trim'],
            ['category_id', 'required'],
            ['category_id', 'integer'],
            ['category_id', 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],

            ['product_id', 'trim'],
            ['product_id', 'required'],
            ['product_id', 'integer'],
            ['product_id', 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],

        ];
    }

    public function attributeLabels(): array
    {
        return [
            'category_id' => Yii::t('app', 'Published At'),
            'product_id' => Yii::t('app', 'Published At'),
        ];
    }
}
