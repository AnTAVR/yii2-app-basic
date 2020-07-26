<?php

namespace app\modules\account\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property-read User|null $user
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $verifyCode;

    private $pUser = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['verifyCode', 'trim'],
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha'],

            ['username', 'trim'],
            ['username', 'required'],

            ['password', 'required'],
            ['password', 'validatePassword'],

            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember Me'),
            'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    /**
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        /** @noinspection PhpSillyAssignmentInspection */
        /** @noinspection PhpUnusedLocalVariableInspection */
        $params = $params;
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        if ($this->pUser === false) {
            $this->pUser = User::findByUsername($this->username);
        }

        return $this->pUser;
    }

    /**
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $params = Yii::$app->getModule('account')->params;
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? $params['duration'] : 0);
        }
        return false;
    }
}
