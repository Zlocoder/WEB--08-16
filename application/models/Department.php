<?php

namespace app\models;

class Department extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'departments';
    }

    public function rules() {
        return [
            [['name', 'city', 'address', 'phone', 'phoneDigits'], 'required'],
            ['name', 'string', 'length' => [5, 50]],
            [['city', 'phone', 'phoneDigits'], 'string', 'length' => [5, 25]],

            ['name', 'unique', 'targetAttribute' => ['name', 'city', 'address']],
            ['phoneDigits', 'unique'],

            ['phone', 'match', 'pattern' => '/^[ +()0-9-]*$/'],
            ['phoneDigits', 'match', 'pattern' => '/^\d*$/']
        ];
    }

    public function getEmployees() {
        return $this->hasMany(Employee::className(), ['departmentId' => 'id']);
    }
}
