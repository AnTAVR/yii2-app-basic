<?php

namespace app\modules\uploader\models;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\base\Model;
use yii\helpers\Json;
use yii\imagine\Image;
use yii\web\UploadedFile;

class UploaderImageForm extends Model
{
    public const MAX_SIZE = 1 * 1024 * 1024;
    public const EXTENSIONS = 'png, jpg, jpeg, gif';
    public const ACCEPT = 'image/jpeg, image/png, image/gif';
    /**
     * @var UploadedFile
     */
    public $fileUpload;
    public $comment;

    public function rules(): array
    {
        $params = Yii::$app->params;
        return [
            ['comment', 'trim'],
            ['comment', 'string',
                'max' => $params['string.max']],

            ['fileUpload', 'image',
                'skipOnEmpty' => false,
                'extensions' => self::EXTENSIONS,
                'maxSize' => self::MAX_SIZE,
                'mimeTypes' => self::ACCEPT,
                'maxFiles' => 0,
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'comment' => Yii::t('app', 'Comment'),
            'fileUpload' => Yii::t('app', 'File'),
        ];
    }

    public function attributeHints(): array
    {
        $params = Yii::$app->params;
        return [
            'fileUpload' => Yii::t('app', 'Max size {size} {bytes}.', [
                    'size' => Yii::$app->formatter->asOrdinal(self::MAX_SIZE), 'bytes' => 'Bytes']) . ' '
                . Yii::t('app', 'Extensions "{extensions}"', ['extensions' => self::EXTENSIONS]),
            'comment' => Yii::t('app', 'Max length {length}', ['length' => $params['string.max']]),
        ];
    }

    public function upload(): string
    {
        $this->fileUpload = UploadedFile::getInstances($this, 'fileUpload');
        if (!$this->validate()) {
            return Json::encode($this->errors);
        }
        $files = [];
        foreach ($this->fileUpload as $file) {
            $modelFile = new UploaderImage([
                'comment' => $this->comment,
                'file' => $file->name,
                'meta_url' => uniqid(time(), true) . '.' . $file->extension,
            ]);

            if (!$file->saveAs($modelFile->imagePath)) {
                return Json::encode($file->error);
            }

            if (!$modelFile->save()) {
                return Json::encode($modelFile->errors);
            }

            $this->generateImageThumb($modelFile->imagePath, $modelFile->thumbnailPath);

            $files[] = [
                'name' => $file->name,
                'size' => $file->size,
                'url' => $modelFile->url,
                'deleteUrl' => 'delete?id=' . $modelFile->id,
                'deleteType' => 'post'
            ];
        }

        return Json::encode([
            'files' => $files,
        ]);
    }

    public function generateImageThumb($path, $thumbPath, $width = 200, $quality = 90): void
    {
        $mode = ManipulatorInterface::THUMBNAIL_INSET;

        $image = Image::getImagine()->open($path);
        $imageWidth = $image->getSize()->getWidth();
        $imageHeight = $image->getSize()->getHeight();

        $ratio = $imageWidth / $imageHeight;
        $height = ceil($width / $ratio);

        // Fix error "PHP GD Allowed memory size exhausted".
        ini_set('memory_limit', '512M');
        Image::thumbnail($path, $width, $height, $mode)->save($thumbPath, ['quality' => $quality]);
    }
}
