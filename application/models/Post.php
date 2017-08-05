<?php

namespace app\models;

class Post extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'posts';
    }

    public function rules() {
        return [
            ['name', 'required'],
            ['name', 'string', 'min' => 3, 'max' => 25],
            ['name', 'unique']
        ];
    }

    public function getEmployees() {
        return $this->hasMany(Employee::className(), ['postId' => 'id']);
    }

    public function attributeLabels() {
        return [
            'name' => 'Название'
        ];
    }
}