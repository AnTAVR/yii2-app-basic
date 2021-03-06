<?php

use app\modules\uploader\models\UploaderImage;
use yii\db\Migration;

class m000001_001100_insert_uploader_image extends Migration
{
    public $tableName;

    public function init(): void
    {
        parent::init();
        $this->tableName = UploaderImage::tableName();
    }

    public function up()
    {
        $this->insert($this->tableName, [
                'file' => 'image.png',
                'comment' => 'image',

                'meta_url' => 'default.png',
            ]
        );
    }

    public function down()
    {
        $this->delete($this->tableName, ['meta_url' => 'default.png']);
    }
}
