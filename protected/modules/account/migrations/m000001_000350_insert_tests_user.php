<?php

use app\modules\account\components\UserStatus;
use app\modules\account\models\User;
use yii\db\Migration;

class m000001_000350_insert_tests_user extends Migration
{
    public $tableName;

    public function init()
    {
        parent::init();
        $this->tableName = User::tableName();
    }

    public function up()
    {
        $security = Yii::$app->security;

        $this->insert($this->tableName, [
            'username' => 'tests',
            'email' => 'tests@tests.tests',
            'email_confirmed' => true,
            'auth_key' => $security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('teststests'),
            'status' => UserStatus::ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->delete($this->tableName, ['username' => 'tests']);
    }
}
