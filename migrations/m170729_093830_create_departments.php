<?php

use yii\db\Migration;

class m170729_093830_create_departments extends Migration
{
    public function safeUp()
    {
        $this -> createTable('departments',[
           'id' => $this -> primaryKey(),
           'name' => $this -> string(50) -> notNull(),
           'city' => $this -> string(25) -> notNull(),
           'address' => $this -> string(100)->notNull(),
           'phone' => $this -> string(25) -> notNull(),
            'phoneDigits' => $this->string(25)->notNull()
        ]);

        $this->createIndex('department_phoneDigits', 'departments', 'phoneDigits', true);
        $this->createIndex('department_name', 'departments', ['name', 'city', 'address'], true);
    }

    public function safeDown()
    {
            $this -> dropTable('departments');
    }
}
