<?php

use app\modules\statics\models\StaticPage;
use yii\db\Migration;

class m000001_001400_create_statics extends Migration
{
    public $tableName;

    // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function init(): void
    {
        parent::init();
        $this->tableName = StaticPage::tableName();
    }

    public function up()
    {
        if ($this->db->driverName !== 'mysql') {
            $this->tableOptions = null;
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),

            'content_title' => $this->string()->notNull(),
            'content_full' => $this->text()->notNull(),

            'meta_url' => $this->string()->notNull()->unique(),
            'meta_description' => $this->string(),
            'meta_keywords' => $this->string(),
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
