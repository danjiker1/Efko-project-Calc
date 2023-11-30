<?php

use yii\db\Migration;

class m231015_215453_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100),
            'email' => $this->string(100),
            'password' => $this->string(100),
            'role' => $this->string(100)->notNull()->defaultValue('user'),
            'created_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
{
    $this->dropTable('users');
}
}
