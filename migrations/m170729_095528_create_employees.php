<?php

use yii\db\Migration;

class m170729_095528_create_employees extends Migration
{
    public function safeUp()
    {
        $this -> createTable('employees', [
            'id' => $this -> primaryKey(),
            'firstname' => $this -> string(25)->notNull(),
            'lastname' => $this -> string(25) -> notNull(),
            'phone' => $this -> string(25) -> notNull(),
            'phoneDigits' => $this->string(25)->notNull(),
            'birth' => $this -> date() -> notNull(),
            'employed' => $this -> date() -> notNull(),
            'departmentId' => $this -> integer(11) -> notNull(),
            'postId' => $this -> integer(11) -> notNull()
        ]);

        $this->createIndex('employees_phoneDigits', 'employees', 'phoneDigits', true);

        $this -> addForeignKey('departmentId','employees', 'departmentId', 'departments', 'id');
        $this -> addForeignKey('postId','employees', 'postId', 'posts', 'id');
    }

    public function safeDown()
    {
        $this -> dropTable('employees');
    }

}
