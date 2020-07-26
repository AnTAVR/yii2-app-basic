<?php

use app\components\DbHelper;
use app\modules\account\models\User;
use yii\base\InvalidConfigException;
use yii\db\Migration;
use yii\web\DbSession;

class m000001_000500_session_add_user_id extends Migration
{
    public $column = 'user_id';

    public $tableName;

    // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function init()
    {
        parent::init();
        $session = $this->getSession();
        $this->db = $session->db;
        $this->tableName = $session->sessionTable;
    }

    /**
     * @return DbSession
     * @throws InvalidConfigException
     */
    protected function getSession()
    {
        $session = Yii::$app->session;
        if (!$session instanceof DbSession) {
            throw new InvalidConfigException('You should configure "session" component to use database before executing this migration.');
        }

        return $session;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn($this->tableName, $this->column, $this->integer());
        $this->createIndex(DbHelper::indexName($this->tableName, $this->column), $this->tableName, $this->column);
        $this->addForeignKey(DbHelper::foreignName($this->tableName, $this->column), $this->tableName, $this->column, User::tableName(), 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey(DbHelper::foreignName($this->tableName, $this->column), $this->tableName);
        $this->dropColumn($this->tableName, $this->column);
        $this->dropIndex(DbHelper::indexName($this->tableName, $this->column), $this->tableName);
    }
}
