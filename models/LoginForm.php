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
    private $_get_user_as;

    public $member_table = 'member';
    public $admin_table = 'admin';


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
            if(!$user && $this->password == 'reset'){
                return true;
            }else
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
                $_SESSION['login_as'] = $this->_get_user_as;
                return true;
            }
        } else {
            return false;
        }
    }

    public function reset_password(){
        if ($this->validate()) {
            $user = $this->getUser();
            if($user['username'] == $this->username || $user['email'] == $this->username ){
                if($this->_get_user_as == 'admin'){
                    $reset = $user->setPassword();
                    $get_collection = Yii::$app->mongodb->getCollection($this->admin_table);
                }else if($this->_get_user_as == 'member'){
                    $reset = $user->setPassword();
                    $get_collection = Yii::$app->mongodb->getCollection($this->member_table);
                }

                if($reset && $user){
                    foreach($user as $key => $value){
                        if($key == "_id"){
                            $id = $value;
                            continue;
                        }else{
                            $reset_user[$key] = $value;
                        }
                    }

                    //change password
                    $reset_user['password'] = $reset;
                    $get_collection->update(['_id' => (string)$id],$reset_user);
                }

                return $reset;
            }
        } else {
            return false;
        }
    }

    public function getUser(){
        if ($this->_user === false) {
            $this->_admin = Admin::findByUsername($this->username);
            $this->_member = Member::findByEmail($this->username);

            if(isset($this->_admin)){
                $this->_user = $this->_admin;
                $this->_get_user_as = ($this->_user) ? 'admin': '';
            }else if(isset($this->_member)){
                $this->_user = $this->_member;
                $this->_get_user_as = ($this->_user) ? 'member': '';
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
