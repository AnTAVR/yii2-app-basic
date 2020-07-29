<?php

use app\modules\account\models\User;
use app\modules\account\traits\IActiveUserStatus;
use yii\db\Migration;

class m000001_000300_insert_admin_user extends Migration
{
    public $tableName;

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
        $params = Yii::$app->params;

        $security = Yii::$app->security;

        $this->insert($this->tableName, [
            'username' => 'admin',
            'email' => $params['adminEmail'],
            'email_confirmed' => true,
            'auth_key' => $security->generateRandomString(),
            'password_hash' => $security->generatePasswordHash('adminadmin'),
            'status' => IActiveUserStatus::ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete($this->tableName, ['username' => 'admin']);
    }
}
