<?php

namespace app\models\forms;

use app\models\Post;

class PostFilter extends \yii\base\Model {
    public $name;

    public function rules() {
        return [
            ['name', 'string', 'max' => 25]
        ];
    }

    public function getFilterQuery() {
        $this->validate();

        $query = Post::find();

        if ($this->name && !$this->hasErrors('name')) {
            $query->where(['like', 'name', $this->name]);
        }

        return $query;
    }
}