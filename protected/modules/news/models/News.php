<?php

namespace app\modules\news\models;

use app\modules\news\traits\IActiveNewsStatus;
use app\modules\news\traits\NewsStatusTrait;
use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Database fields:
 * @property int $id [int(11)]
 * @property string $content_title [varchar(255)]
 * @property string $content_short [string(1024)]
 * @property string $content_full [text(65535)]
 * @property string $meta_url [varchar(255)]
 * @property string $meta_description [varchar(255)]
 * @property string $meta_keywords [varchar(255)]
 * @property int $published_at [int(11)]
 * @property int $status [smallint(6)]
 * @property int $view_count [int(11)]
 *
 * Fields:
 * @property null|string|int $published
 * @property string $url
 * @property array $arrUrl
 */
class News extends ActiveRecord
{
    use NewsStatusTrait;

    public const CONTENT_SHORT_MAX_SIZE = 1024;
    public const CONTENT_FULL_MAX_SIZE = 65535;

    public static function tableName(): string
    {
        return '{{%news}}';
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
                'value' => IActiveNewsStatus::DRAFT],
            ['status', 'in', 'range' => NewsStatusTrait::getStatusRange()],
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
        return ['/news/default/view', 'meta_url' => $this->meta_url];
    }

    public function getUrl(): string
    {
        return Url::to($this->arrUrl);
    }
}
