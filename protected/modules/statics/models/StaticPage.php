<?php

namespace app\modules\statics\models;

use app\widgets\UrlTranslit\UrlTranslit;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Database fields:
 * @property int $id [int(11)]
 * @property string $content_title [varchar(255)]
 * @property string $content_full
 * @property string $meta_url [varchar(255)]
 * @property string $meta_description [varchar(255)]
 * @property string $meta_keywords [varchar(255)]
 *
 * Fields:
 * @property string $url
 */
class StaticPage extends ActiveRecord
{
    public const CONTENT_FULL_MAX_SIZE = 65535;

    public static function tableName()
    {
        return '{{%statics}}';
    }

    public function rules()
    {
        $params = Yii::$app->params;
        return [
            ['content_title', 'trim'],
            ['content_title', 'required'],
            ['content_title', 'string',
                'max' => $params['string.max']],

            ['content_full', 'trim'],
            ['content_full', 'required'],
            ['content_full', 'string',
                'max' => self::CONTENT_FULL_MAX_SIZE],

            ['meta_url', 'trim'],
            ['meta_url', 'required'],
            ['meta_url', 'string',
                'max' => $params['string.max']],
            ['meta_url', 'match',
                'pattern' => UrlTranslit::PATTERN],
            ['meta_url', 'unique'],

            ['meta_description', 'trim'],
            ['meta_description', 'string',
                'max' => $params['string.max']],

            ['meta_keywords', 'trim'],
            ['meta_keywords', 'string',
                'max' => $params['string.max']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content_title' => Yii::t('app', 'Content Title'),
            'content_full' => Yii::t('app', 'Content Full'),
            'meta_url' => Yii::t('app', 'Meta Url'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'url' => Yii::t('app', 'Static Url'),
        ];
    }

    public function attributeHints()
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

    public function getUrl()
    {
        return Url::to(['/statics/default/index', 'meta_url' => $this->meta_url]);
    }
}
