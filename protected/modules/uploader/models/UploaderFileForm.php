<?php

namespace app\modules\uploader\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\UploadedFile;

class UploaderFileForm extends Model
{
    public const MAX_SIZE = 1 * 1024 * 1024;
    /**
     * @var UploadedFile
     */
    public $fileUpload;
    public $comment;

    public function rules()
    {
        $params = Yii::$app->params;
        return [
            ['comment', 'trim'],
            ['comment', 'string',
                'max' => $params['string.max']],

            ['fileUpload', 'file',
                'skipOnEmpty' => false,
                'maxSize' => self::MAX_SIZE,
                'maxFiles' => 0,
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'comment' => Yii::t('app', 'Comment'),
            'fileUpload' => Yii::t('app', 'File'),
        ];
    }

    public function attributeHints()
    {
        $params = Yii::$app->params;
        return [
            'fileUpload' => Yii::t('app', 'Max size {size} {bytes}.', [
                'size' => Yii::$app->formatter->asOrdinal(self::MAX_SIZE), 'bytes' => 'Bytes']),
            'comment' => Yii::t('app', 'Max length {length}', ['length' => $params['string.max']]),
        ];
    }

    public function upload()
    {
        $this->fileUpload = UploadedFile::getInstances($this, 'fileUpload');
        if (!$this->validate()) {
            return Json::encode($this->errors);
        }
        $files = [];
        foreach ($this->fileUpload as $file) {
            $modelFile = new UploaderFile([
                'comment' => $this->comment,
                'file' => $file->name,
                'meta_url' => uniqid(time(), true) . '.' . $file->extension,
            ]);

            if (!$file->saveAs($modelFile->filePath)) {
                return Json::encode($file->error);
            }

            if (!$modelFile->save()) {
                return Json::encode($modelFile->errors);
            }

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
}
