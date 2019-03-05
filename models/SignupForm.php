<?php
namespace app\models;


use Yii;
use yii\base\Model;
use app\models\Admin;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            // ['username', 'unique', 'targetClass' => 'app\models\Admin', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            // ['email', 'unique', 'targetClass' => 'app\models\Admin', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new admin();
            $admin = array(
                'username' => $this->username,
                'email' => $this->email,
                'password' => $user->setPassword($this->password),
                'authKey' => $user->generateAuthKey(),
            );

            $user->insert($admin);
            return $user;
        }
        return null;
    }
}