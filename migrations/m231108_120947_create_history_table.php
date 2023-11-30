<?php

use yii\db\Migration;

class m231108_120947_create_history_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey(),
            'user_id' =>  $this->integer()->unsigned()->notNull(),
            'raw_type_id' => $this->integer()->unsigned()->notNull(),
            'tonnage_id' => $this->integer()->unsigned()->notNull(),
            'month_id' => $this->integer()->unsigned()->notNull(),
            'price' => $this->decimal(10, 2),
        ]);

        $this->addForeignKey(
            'fk-history-user_id',
            'history',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
        $this->addForeignKey('fk-history-month_id', 'history', 'month_id', 'months', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk-history-tonnage_id', 'history', 'tonnage_id', 'tonnages', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk-history-raw_type_id', 'history', 'raw_type_id', 'raw_types', 'id', 'CASCADE', 'NO ACTION');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-history-user_id',
            'history'
        );
        $this->dropForeignKey('fk-history-raw_type_id', 'history');
        $this->dropForeignKey('fk-history-tonnage_id', 'history');
        $this->dropForeignKey('fk-history-month_id', 'history');

        $this->dropTable('history');
    }
}