<?php

namespace app\modules\products\models;

use app\modules\products\traits\IActiveProductsStatus;
use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Database fields:
 * @property int $id [int(11)]
 * @property int $published_at [int(11)]
 * @property string $content_title [varchar(255)]
 * @property string $content_full
 * @property string $meta_url [varchar(255)]
 * @property string $meta_description [varchar(255)]
 * @property string $meta_keywords [varchar(255)]
 *
 * Fields:
 * @property null|string|int $published
 * @property-read string $url
 * @property-read integer|string $count
 * @property-read array $product [Products]
 * @property-read array $arrUrl
 */
class Category extends ActiveRecord
{
    public const CONTENT_FULL_MAX_SIZE = 65535;

    public static function tableName(): string
    {
        return '{{%products_category}}';
    }

    public function rules(): array
    {
        $params = Yii::$app->params;
        return [
            ['published', 'trim'],
            ['published', 'datetime'],

            ['content_title', 'trim'],
            ['content_title', 'required'],
            ['content_title', 'string',
                'max' => $params['string.max']],

            ['content_full', 'trim'],
            ['content_full', 'required'],
            ['content_full', 'string',
                'max' => self::CONTENT_FULL_MAX_SIZE],

            ['meta_description', 'trim'],
            ['meta_description', 'string',
                'max' => $params['string.max']],

            ['meta_keywords', 'trim'],
            ['meta_keywords', 'string',
                'max' => $params['string.max']],

            ['meta_url', 'trim'],
            ['meta_url', 'required'],
            ['meta_url', 'string',
                'max' => $params['string.max']],
            ['meta_url', 'match',
                'pattern' => UrlTranslit::PATTERN],
            ['meta_url', 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),

            'published_at' => Yii::t('app', 'Published At'),
            'published' => Yii::t('app', 'Published At'),

            'content_title' => Yii::t('app', 'Title'),
            'content_full' => Yii::t('app', 'Content Full'),

            'meta_url' => Yii::t('app', 'Meta Url'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),

            'url' => Yii::t('app', 'Url'),
            'count' => Yii::t('app', 'Count'),
        ];
    }

    public function attributeHints(): array
    {
        $params = Yii::$app->params;
        return [
            'content_title' => Yii::t('app', 'Max length {length}', ['length' => $params['string.max']]),
            'content_full' => Yii::t('app', 'Max length {length}', ['length' => self::CONTENT_FULL_MAX_SIZE]),
            'meta_url' => Yii::t('app', 'Possible characters ({chars})', ['chars' => UrlTranslit::HINT]),
            'meta_description' => Yii::t('app', 'Max length {length}', ['length' => $params['string.max']]),
            'meta_keywords' => Yii::t('app', 'Max length {length}', ['length' => $params['string.max']]),
        ];
    }

    /**
     * @return int|string|null
     * @throws InvalidConfigException
     */
    public function getPublished()
    {
        return $this->published_at ? Yii::$app->formatter->asDatetime($this->published_at) : $this->published_at;
    }

    /**
     * @param string|null $value
     */
    public function setPublished($value): void
    {
        $this->published_at = $value ? Yii::$app->formatter->asTimestamp($value) : $value;
    }

    public function getArrUrl(): array
    {
        return ['/products/category/view', 'meta_url' => $this->meta_url];
    }

    public function getUrl(): string
    {
        return Url::to($this->arrUrl);
    }

    public function getCount()
    {
        return Products::find()->where(['category_id' => $this->id])->count();
    }

    public function getProduct()
    {
        if (($model = Products::find()
                ->where(['category_id' => $this->id, 'status' => IActiveProductsStatus::ACTIVE])
                ->orderBy(['published_at' => SORT_DESC, 'id' => SORT_ASC])
//                ->limit(10)
                ->all()
            ) !== null
        ) {
            return $model;
        }
        return [];
    }
}
