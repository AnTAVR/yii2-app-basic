<?php

namespace app\modules\products\models;

use app\modules\products\traits\IActiveProductsStatus;
use app\modules\products\traits\ProductsStatusTrait;
use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Database fields:
 * @property int $id [int(11)]
 * @property int $published_at [int(11)]
 * @property int $status [smallint(6)]
 * @property string $content_title [varchar(255)]
 * @property string $content_short
 * @property string $content_full
 * @property string $meta_url [varchar(255)]
 * @property string $meta_description [varchar(255)]
 * @property string $meta_keywords [varchar(255)]
 * @property int $view_count [int(11)]
 *
 * Fields:
 * @property null|string|int $published
 * @property-read array $categories [Category]
 * @property-read mixed $relations [Relations]
 * @property string $url
 * @property array $arrUrl
 */
class Products extends ActiveRecord
{
    use ProductsStatusTrait;

    public const CONTENT_SHORT_MAX_SIZE = 1024;
    public const CONTENT_FULL_MAX_SIZE = 65535;

    public static function tableName(): string
    {
        return '{{%products}}';
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

            ['content_short', 'trim'],
            ['content_short', 'required'],
            ['content_short', 'string',
                'max' => self::CONTENT_SHORT_MAX_SIZE],

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

            ['status', 'required'],
            ['status', 'integer'],
            ['status', 'default',
                'value' => IActiveProductsStatus::DRAFT],
            ['status', 'in', 'range' => ProductsStatusTrait::getStatusRange()],

            ['categories', 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),

            'published_at' => Yii::t('app', 'Published At'),
            'published' => Yii::t('app', 'Published At'),
            'status' => Yii::t('app', 'Status'),

            'content_title' => Yii::t('app', 'Title'),
            'content_short' => Yii::t('app', 'Content Short'),
            'content_full' => Yii::t('app', 'Content Full'),

            'meta_url' => Yii::t('app', 'Meta Url'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),

            'view_count' => Yii::t('app', 'View Count'),

            'url' => Yii::t('app', 'Url'),
        ];
    }

    public function attributeHints(): array
    {
        $params = Yii::$app->params;
        return [
            'content_title' => Yii::t('app', 'Max length {length}', ['length' => $params['string.max']]),
            'content_short' => Yii::t('app', 'Max length {length}', ['length' => self::CONTENT_SHORT_MAX_SIZE]),
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
        return ['/products/default/view', 'meta_url' => $this->meta_url];
    }

    public function getUrl(): string
    {
        return Url::to($this->arrUrl);
    }

    public function getRelations(): ActiveQuery
    {
        return $this->hasMany(Relations::class, ['product_id' => 'id']);
    }

    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->via('relations')
            ->orderBy(['published_at' => SORT_DESC, 'id' => SORT_ASC]);
    }

    /**
     * @param $value int[]
     */
    public function setCategories($value): void
    {
        Relations::deleteAll(['product_id' => $this->id]);
        if (is_array($value)) {
            foreach ($value as $category_id) {
                $rel = new Relations(['product_id' => $this->id, 'category_id' => $category_id]);
                $rel->save();
            }
        }
    }
}
