<?php

namespace app\models;

use Yii;
use yii\mongodb\Query;
use yii\mongodb\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class member extends ActiveRecord
{
    const STATUS_INACTIVE = 2;
    const STATUS_ACTIVE = 1;

    public static function collectionName()
    {
        return 'member';
    }

    public function rules()
    {
        return [
            [['name', 'address', 'email','status', 'username'], 'required'],
            [['name', 'address', 'email','status', 'username'], 'required'],
            [['name', 'address', 'passwowrd', 'confirm_password'], 'string'],
            [['name'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['name'], 'string', 'max' => 100],
            ['email', 'email']
        ];
    }

    public function attributes()
    {
        return ['_id', 'name', 'username', 'email', 'address', 'status', 'password', 'confirm_password'];
    }

    public static function findIdentity($id) {

        return static::findOne(['_id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public function getId(){
        return (string)$this->getAttribute('_id');
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password) {
        return $password == $this->password    ;
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function logs($message){
        $date = date('d.m.Y h:i:s');
        $log = "[Date:  ".$date."] Model/Member -  Msg: display ".print_r($message, true) ."\n";
        error_log($log, 3, "c:/code/my-errors.log");
    }

}