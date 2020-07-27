<?php

namespace app\modules\uploader\models;

use ErrorException;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

/**
 * Database fields:
 * @property int $id [int(11)]
 * @property string $file [varchar(255)]
 * @property string $meta_url [varchar(255)]
 * @property string $comment [varchar(255)]
 *
 * Fields:
 * @property string $imagePath
 * @property string $thumbnailPath
 * @property string $url
 * @property string $thumbnailUrl
 */
class UploaderImage extends ActiveRecord
{
    public const PATH_IMAGES = 'images';
    public const PATH_THUMBNAIL = 'thumbnail';

    public static function tableName()
    {
        return '{{%uploader_image}}';
    }

    public function rules()
    {
        $params = Yii::$app->params;
        return [
            ['comment', 'trim'],
            ['comment', 'string',
                'max' => $params['string.max']],

            ['file', 'trim'],
            ['file', 'required'],
            ['file', 'string',
                'max' => $params['string.max']],

            ['meta_url', 'trim'],
            ['meta_url', 'required'],
            ['meta_url', 'string',
                'max' => $params['string.max']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file' => Yii::t('app', 'File'),
            'meta_url' => Yii::t('app', 'Meta Url'),
            'comment' => Yii::t('app', 'Comment'),
            'url' => Yii::t('app', 'Image Url'),
            'imagePath' => Yii::t('app', 'Image Path'),
            'thumbnailUrl' => Yii::t('app', 'Thumbnail Url'),
            'thumbnailPath' => Yii::t('app', 'Thumbnail Path'),
        ];
    }

    public function getUrl()
    {
        return static::getUploadUrl() . $this->meta_url;
    }

    public static function getUploadUrl()
    {
        return Yii::getAlias('@upload_web') . '/' . static::PATH_IMAGES . '/';
    }

    public function getImagePath()
    {
        return static::getUploadPath() . $this->meta_url;
    }

    public static function getUploadPath()
    {
        $path = Yii::getAlias('@upload_path') . DIRECTORY_SEPARATOR . static::PATH_IMAGES;
        if (!is_dir($path)) {
            FileHelper::createDirectory($path, 0775, true);
        }
        return $path . DIRECTORY_SEPARATOR;
    }

    public function getThumbnailUrl()
    {
        return static::getUploadThumbnailUrl() . $this->meta_url;
    }

    public static function getUploadThumbnailUrl()
    {
        return static::getUploadUrl() . self::PATH_THUMBNAIL . '/';
    }

    public function getThumbnailPath()
    {
        return static::getUploadThumbnailPath() . $this->meta_url;
    }

    public static function getUploadThumbnailPath()
    {
        $path = static::getUploadPath() . self::PATH_THUMBNAIL;
        if (!is_dir($path)) {
            FileHelper::createDirectory($path, 0775, true);
        }
        return $path . DIRECTORY_SEPARATOR;
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $no_errors = true;

        try {
            unlink($this->thumbnailPath);
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (ErrorException $e) {
            Yii::error($e);
            $no_errors = !file_exists($this->thumbnailPath);
        }

        try {
            unlink($this->imagePath);
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (ErrorException $e) {
            Yii::error($e);
            $no_errors = !file_exists($this->imagePath) && $no_errors;
        }

        return $no_errors;
    }
}
