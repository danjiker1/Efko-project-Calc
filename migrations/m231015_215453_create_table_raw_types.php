<?php

use yii\db\Migration;

class m231015_215453_create_table_raw_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('raw_types', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(10)->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull()->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        
        $this->batchInsert('raw_types', ['name'], [
            ['Соя'],
            ['Шрот'],
            ['Жмых'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('raw_types');
    }

}
