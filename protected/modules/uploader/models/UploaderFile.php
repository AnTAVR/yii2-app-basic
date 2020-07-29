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
 * @property string $filePath
 * @property string $url
 */
class UploaderFile extends ActiveRecord
{
    public const PATH_FILES = 'files';

    public static function tableName(): string
    {
        return '{{%uploader_file}}';
    }

    public function rules(): array
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

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file' => Yii::t('app', 'File'),
            'meta_url' => Yii::t('app', 'Meta Url'),
            'comment' => Yii::t('app', 'Comment'),
            'url' => Yii::t('app', 'File Url'),
            'filePath' => Yii::t('app', 'File Path'),
        ];
    }

    public function getUrl(): string
    {
        return static::getUploadUrl() . $this->meta_url;
    }

    public static function getUploadUrl(): string
    {
        return Yii::getAlias('@upload_web') . '/' . static::PATH_FILES . '/';
    }

    public function getFilePath(): string
    {
        return static::getUploadPath() . $this->meta_url;
    }

    public static function getUploadPath(): string
    {
        $path = Yii::getAlias('@upload_path') . DIRECTORY_SEPARATOR . static::PATH_FILES;
        if (!is_dir($path)) {
            FileHelper::createDirectory($path, 0775, true);
        }
        return $path . DIRECTORY_SEPARATOR;
    }

    /**
     * @return bool
     */
    public function beforeDelete(): bool
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $no_errors = true;

        try {
            unlink($this->filePath);
        } catch (ErrorException $e) {
            Yii::error($e);
            $no_errors = !file_exists($this->filePath);
        }

        return $no_errors;
    }
}
