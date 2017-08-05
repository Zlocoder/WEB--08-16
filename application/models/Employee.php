<?php

namespace app\models;

class Employee extends \yii\db\ActiveRecord {
    public $someProperty;
    
    public static function tableName() {
        return 'employees';
    }
    
    public function rules() {
        return [
            [['departmentId', 'postId', 'firstname', 'lastname', 'phone', 'phoneDigits', 'birth', 'employed'], 'required'],
            [['firstname', 'lastname', 'phone', 'phoneDigits'], 'string', 'length' => [5, 25]],
            [['birth', 'employed'], 'date', 'format' => 'php:Y-m-d'],
            ['phoneDigits', 'unique'],
            ['departmentId', 'exist', 'targetClass' => Department::className(), 'targetAttribute' => 'id'],
            ['postId', 'exist', 'targetClass' => Post::className(), 'targetAttribute' => 'id'],
            ['phone', 'match', 'pattern' => '/^[ +()0-9-]*$/'],
            ['phoneDigits', 'match', 'pattern' => '/^\d*$/']
        ];
    }

    public function getDepartment() {
        return $this->hasOne(Department::className(), ['id' => 'departmentId']);
    }

    public function getPost() {
        return $this->hasOne(Post::className(), ['id' => 'postId']);
    }
}
