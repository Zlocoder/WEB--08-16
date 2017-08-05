<?php

use yii\db\Migration;

class m170722_160735_create_posts extends Migration
{
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'name' => $this->string(25)->notNull()->unique()
        ]);

        $this->createIndex('post_name', 'posts', 'name', true);
    }

    public function safeDown()
    {
        $this->dropTable('posts');
    }
}
