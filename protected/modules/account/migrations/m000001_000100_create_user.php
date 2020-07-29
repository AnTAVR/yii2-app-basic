<?php

use app\modules\account\models\User;
use app\modules\account\traits\IActiveUserStatus;
use yii\db\Migration;

class m000001_000100_create_user extends Migration
{
    public $tableName;

    // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        $this->tableName = User::tableName();
    }

    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db->driverName !== 'mysql') {
            $this->tableOptions = null;
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'email_confirmed' => $this->boolean()->notNull()->defaultValue(false),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(IActiveUserStatus::ACTIVE),
            'created_at' => $this->bigInteger()->notNull(),
            'created_ip' => $this->string(45),
            'updated_at' => $this->bigInteger()->notNull(),
            'updated_ip' => $this->string(45),
        ], $this->tableOptions);
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
