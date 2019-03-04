<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class admin extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'admin';
    }

    public function rules()
    {
        return [
            [['name','email', 'password', 'confirm_password','status'], 'required'],
            [['name', 'password'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 100],
            ['email', 'email']
        ];
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'name', 'email', 'password', 'status'];
    }


}