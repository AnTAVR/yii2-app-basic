<?php

use app\helpers\DbHelper;
use app\modules\products\models\Category;
use app\modules\products\models\Products;
use app\modules\products\traits\IActiveProductsStatus;
use yii\db\Migration;

class m000003_000003_create_products extends Migration
{
    public $tableName;

    // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function init(): void
    {
        parent::init();
        $this->tableName = Products::tableName();
    }

    public function up()
    {
        if ($this->db->driverName !== 'mysql') {
            $this->tableOptions = null;
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),

            'published_at' => $this->bigInteger(),
            'category_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(IActiveProductsStatus::DRAFT),

            'content_title' => $this->string()->notNull(),
            'content_short' => $this->text()->notNull(),
            'content_full' => $this->text()->notNull(),

            'meta_url' => $this->string()->notNull()->unique(),
            'meta_description' => $this->string(),
            'meta_keywords' => $this->string(),

            'view_count' => $this->integer()->defaultValue(0),
        ], $this->tableOptions);

        $name = 'published_at';
        $this->createIndex(DbHelper::indexName($this->tableName, $name), $this->tableName, $name);

        $name = 'category_id';
        $this->addForeignKey(DbHelper::foreignName($this->tableName, $name), $this->tableName, $name, Category::tableName(), 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
