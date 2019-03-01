<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class member extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'member';
    }

    public function rules()
    {
        return [
            [['name', 'address', 'email','status'], 'required'],
            [['name, address'], 'string'],
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
        return ['_id', 'name', 'email', 'address', 'status'];
    }



}