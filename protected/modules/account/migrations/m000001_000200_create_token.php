<?php

use app\helpers\DbHelper;
use app\modules\account\models\User;
use app\modules\account\models\UserToken;
use app\modules\account\traits\IActiveTokenType;
use yii\db\Migration;

class m000001_000200_create_token extends Migration
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
        $this->tableName = UserToken::tableName();
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
            'user_id' => $this->integer()->notNull(),
            'code' => $this->string(64)->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(IActiveTokenType::API_AUTH),
            'created_at' => $this->bigInteger()->notNull(),
            'expires_on' => $this->bigInteger()->notNull()->defaultValue(0),
        ], $this->tableOptions);

        $name = 'token_unique';
        $this->createIndex(DbHelper::indexName($this->tableName, $name), $this->tableName, ['user_id', 'code', 'type'], true);

        $name = 'user_id';
        $this->addForeignKey(DbHelper::foreignName($this->tableName, $name), $this->tableName, $name, User::tableName(), 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
