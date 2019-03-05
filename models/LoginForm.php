<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $email;
    public $password;
    private $_user = false;
    private $_admin = false;
    private $_member = false;


    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'], //function
        ];
    }
    public function attributeLabels(){
        return [
            'username' => 'Username/ Email',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($user['password'], $this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login(){
        if ($this->validate()) {
            $user = $this->getUser();
            if($user['username'] == $this->username || $user['email'] == $this->username ){
                $_SESSION['current_user'] = $user;
                return true;
            }
        } else {
            return false;
        }
    }

    public function getUser(){
        if ($this->_user === false) {
            $this->_admin = Admin::findByUsername($this->username);
            $this->_member = Member::findByEmail($this->username);

            $this->logs($this->username);
            $this->logs($this->_admin);
            $this->logs($this->_member);


            if(isset($this->_admin)){
                $this->_user = $this->_admin;
                $_SESSION['login_as']  = ($this->_user) ? 'admin': '';
            }else if(isset($this->_member)){
                $this->_user = $this->_member;
                $_SESSION['login_as']  = ($this->_user) ? 'member': '';
            }
        }
        return $this->_user;
    }

    public function logs($message){
        $date = date('d.m.Y h:i:s');
        $log = "[Date:  ".$date."] Model/LoginForm -  Msg: display ".print_r($message, true) ."\n";
        error_log($log, 3, "c:/code/my-errors.log");
    }

}
