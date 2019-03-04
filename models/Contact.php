<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class contact extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'contact';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name', 'body', 'subject', 'created_at'], 'string'],
            [['name'], 'string', 'max' => 100],
            ['email', 'email']
        ];
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'name', 'email', 'subject', 'body', 'created_at'];
    }



}