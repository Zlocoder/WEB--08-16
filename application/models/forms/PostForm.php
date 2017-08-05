<?php

namespace app\models\forms;

use app\models\Post;
use yii\base\Exception;

class PostForm extends \yii\base\Model {
    public $name;

    private $_post;

    public function setPost($post) {
        $this->_post = $post;
        $this->name = $post->name;
    }

    public function getPost() {
        return $this->_post;
    }

    public function getId() {
        if ($this->_post) {
            return $this->_post->id;
        }

        return null;
    }

    public function rules() {
        return [
            ['name', 'required', 'message' => 'Введите название', 'on' => ['create', 'update']],
            ['name', 'string', 'length' => [5, 25], 'on' => ['create', 'update']],
            ['name', 'unique', 'targetClass' => Post::className(), 'on' => ['create']],

            ['name', 'unique', 'targetClass' => Post::className(), 'filter' => ['!=', 'id', $this->id], 'on' => ['update']]
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название'
        ];
    }

    public function save() {
        if ($this->validate()) {
            switch ($this->scenario) {
                case 'create' :
                    $post = new Post;
                    $post->name = $this->name;

                    if (!$post->save()) {
                        throw new Exception('Can not save Post model');
                    }

                    return true;
                    break;

                case 'update' :
                    if ($this->post) {
                        $this->post->name = $this->name;

                        if (!$this->post->save()) {
                            throw new Exception('Can not save Post model');
                        }

                        return true;
                    }
                    break;
            }
        }

        return false;
    }
}