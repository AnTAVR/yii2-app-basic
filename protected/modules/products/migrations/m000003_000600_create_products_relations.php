<?php

use app\helpers\DbHelper;
use app\modules\products\models\Category;
use app\modules\products\models\Products;
use app\modules\products\models\Relations;
use yii\db\Migration;

class m000003_000600_create_products_relations extends Migration
{
    public $tableName;

    // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function init(): void
    {
        parent::init();
        $this->tableName = Relations::tableName();
    }

    public function up()
    {
        if ($this->db->driverName !== 'mysql') {
            $this->tableOptions = null;
        }

        $this->createTable($this->tableName, [
            'category_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ], $this->tableOptions);

        $name = 'id';
        $this->addPrimaryKey(DbHelper::primaryName($this->tableName, $name), $this->tableName, ['category_id', 'product_id']);

        $name = 'category_id';
        $this->addForeignKey(DbHelper::foreignName($this->tableName, $name), $this->tableName, $name, Category::tableName(), 'id', 'CASCADE', 'CASCADE');

        $name = 'product_id';
        $this->addForeignKey(DbHelper::foreignName($this->tableName, $name), $this->tableName, $name, Products::tableName(), 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
