<?php

namespace app\models\forms;

use app\models\Department;
use yii\base\Exception;

class DepartmentForm extends \yii\base\Model {
    public $name;

    public $city;

    public $address;

    public $phone;

    private $_post;

    public function setDepartment ($post) {
        $this->_post = $post;
        $this->name = $post->name;
        $this->city = $post->city;
        $this->address = $post->address;
        $this->phone = $post->phone;
    }

    public function getDepartment () {
        return $this->_post;
    }

    public function getId () {
        if ($this->_post) {
            return $this->_post->id;
        }
        return null;
    }

    public function rules () {
        return [
            [['name', 'city', 'address', 'phone'], 'required', 'on' => ['create', 'update']],
            [['name', 'city', 'address', 'phone'], 'string', 'length' => ['5', '25'], 'on' => ['create', 'update']],
            ['phone', 'unique', 'targetClass' => Department::className(), 'on' => 'create'],

            ['phone', 'unique', 'targetClass' => Department::className(), 'filter' => ['!=', 'id', $this->id], 'on' => 'update']
        ];
    }

    public function attributeLabels () {
        return [
            'name' => 'Название',
            'city' => 'Город',
            'address' => 'Адрес',
            'phone' => 'Телефон'
        ];
    }

    public function save () {
        if ($this->validate()) {
            switch ($this->scenario) {
                case 'create':
                    $department = new Department;
                    $department->name = $this->name;
                    $department->city = $this->city;
                    $department->address = $this->address;
                    $department->phone = $this->phone;
                    $department->phoneDigits = preg_replace('/[^0-9]/', '', $this->phone);

                    if (!$department->save()) {
                        throw new Exception('Can not save department model');
                    }

                    return true;
                    break;
                case 'update' :
                    if ($this->department) {
                        $this->department->name = $this->name;
                        $this->department->city = $this->city;
                        $this->department->address = $this->address;
                        $this->department->phone = $this->phone;

                        if (!$this->department->save()) {
                            throw new Exception('Can not save department model');
                        }
                        return true;
                    }
                    break;
            }
        }
        return false;
    }
}