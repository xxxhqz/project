<?php

namespace app\models;

use Yii;
use yii\mongodb\Query;
use yii\mongodb\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;


class admin extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static function collectionName(){
        return 'admin';
    }

    public function attributes(){
        return ['_id', 'username', 'email','auth_key', 'password', 'status'];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules() {
        return [
            ['username', 'unique'],
            ['email', 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
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
        return $password === $this->password;
    }

    public function setPassword() {
        $this->password = rand(10000,99999);
        // $help = $this->setAttribute('password', $this->password);
        // $this->logs($help );
        return $this->password;
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    public static function logs($message){
        $date = date('d.m.Y h:i:s');
        $log = "[Date:  ".$date."] Model/Admin -  Msg: display ".print_r($message, true) ."\n";
        error_log($log, 3, "c:/code/my-errors.log");
    }



}