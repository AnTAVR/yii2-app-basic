<?php

namespace app\modules\callback\models;

use borales\extensions\phoneInput\PhoneInputValidator;
use Yii;
use yii\base\Model;

class CallbackForm extends Model
{
    public $phone;
    public $name;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        $params = Yii::$app->params;
        return [
            ['verifyCode', 'trim'],
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha'],

            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string',
                'max' => $params['string.max']],

            ['name', 'trim'],
            ['phone', 'required'],
            ['phone', 'string'],
            ['phone', PhoneInputValidator::class],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'phone' => Yii::t('app', 'Contact number'),
            'name' => Yii::t('app', 'Name'),
            'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    public function attributeHints()
    {
        return [
            'name' => Yii::t('app', 'How can I call you?'),
        ];
    }

    /**
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        $body = Yii::t('app', 'Phone {phone}, name {name}', ['phone' => $this->phone, 'name' => $this->name]);
        $subject = Yii::t('app', 'Request for a call back from {site}', ['site' => Yii::$app->name]);

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::t('app', '{appname} robot', ['appname' => Yii::$app->name])])
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
    }
}
