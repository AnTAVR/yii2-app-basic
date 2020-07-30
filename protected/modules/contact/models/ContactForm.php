<?php

namespace app\modules\contact\models;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
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

            ['subject', 'trim'],
            ['subject', 'required'],
            ['subject', 'string',
                'max' => $params['string.max']],

            ['body', 'trim'],
            ['body', 'required'],
            ['body', 'string',
                'max' => $params['contact.body.max']],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'string',
                'max' => $params['email.max']],
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels(): array
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'E-Mail'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Body'),
            'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    public function attributeHints(): array
    {
        return [
            'name' => Yii::t('app', 'How can I call you?'),
        ];
    }

    /**
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function sendEmail($email): bool
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::t('app', '{appname} robot', ['appname' => Yii::$app->name])])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
