<?php

namespace app\modules\account\models;

use app\modules\account\traits\IActiveTokenType;
use app\modules\account\traits\TokenTypeTrait;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Database fields:
 * @property integer $user_id [int(11)]
 * @property string $code [varchar(64)]
 * @property integer $type [smallint(6)]
 * @property integer $created_at [int(11)]
 * @property integer $expires_on [int(11)]
 *
 * Fields:
 */
class UserToken extends ActiveRecord
{
    use TokenTypeTrait;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%user_token}}';
    }

    /**
     * @param string $code
     * @param integer $type The type of the token
     * @return static
     */
    public static function findByCode($code, $type = IActiveTokenType::API_AUTH)
    {
        return static::findOne(['code' => $code, 'type' => $type]);
    }

    /**
     * @param integer $userId
     * @param integer $expiresOn
     * @return UserToken|object|null
     * @throws InvalidConfigException
     * @throws Exception
     */
    public static function createApiAuthToken($userId, $expiresOn)
    {
        return static::createToken($userId, IActiveTokenType::API_AUTH, $expiresOn);
    }

    /**
     * @param integer $userId
     * @param integer $type
     * @param integer $expiresOn
     * @return UserToken|object|null
     * @throws InvalidConfigException
     * @throws Exception
     */
    public static function createToken($userId, $type, $expiresOn)
    {
        $token = Yii::createObject([
            'class' => static::class,
            'user_id' => $userId,
            'type' => $type,
            'code' => Yii::$app->security->generateRandomString() . '_' . time(),
            'expires_on' => $expiresOn,
        ]);
        return $token->save(false) ? $token : null;
    }

    /**
     * @param integer $userId
     * @return UserToken|object|null
     * @throws Exception
     * @throws InvalidConfigException
     */
    public static function createConfirmEmailToken($userId)
    {
        $params = Yii::$app->getModule('account')->params;
        $expiresOn = time() + $params['expires_confirm_email'];
        return static::createToken($userId, IActiveTokenType::CONFIRM_EMAIL, $expiresOn);
    }

    /**
     * @param integer $userId
     * @return UserToken|object|null
     * @throws Exception
     * @throws InvalidConfigException
     */
    public static function createRecoveryPasswordToken($userId)
    {
        $params = Yii::$app->getModule('account')->params;
        $expiresOn = time() + $params['expires_recovery_password'];
        return static::createToken($userId, IActiveTokenType::RECOVERY_PASSWORD, $expiresOn);
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],

            ['type', 'required'],
            ['type', 'integer'],
            ['type', 'default',
                'value' => IActiveTokenType::API_AUTH],
            ['type', 'in', 'range' => static::getTokenRange()],

            ['expires_on', 'required'],
            ['expires_on', 'integer'],

            ['code', 'trim'],
            ['code', 'required'],
            ['code', 'string',
                'max' => 64],
            ['code', 'unique',
                'targetAttribute' => ['user_id', 'code', 'type'],
                'message' => Yii::t('app', 'The combination of User ID, Code and Type has already been taken.')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'code' => Yii::t('app', 'Code'),
            'created_at' => Yii::t('app', 'Created At'),
            'type' => Yii::t('app', 'Type'),
            'expires_on' => Yii::t('app', 'Expires On'),
        ];
    }

    /**
     * @return boolean
     */
    public function isExpired(): bool
    {
        return ($this->expires_on > 0) && ($this->expires_on < time());
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryKey($asArray = false)
    {
        return ['user_id', 'code', 'type'];
    }
}
