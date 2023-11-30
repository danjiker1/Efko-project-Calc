<?php

use yii\db\Migration;

class m231016_215945_create_table_prices extends Migration
{
    public function safeUp()
    {
        $this->createTable('prices', [
            'id' => $this->primaryKey()->unsigned(),
            'price' => $this->tinyInteger(3)->unsigned()->notNull(),
            'month_id' => $this->integer(11)->unsigned()->notNull(),
            'tonnage_id' => $this->integer(11)->unsigned()->notNull(),
            'raw_type_id' => $this->integer(11)->unsigned()->notNull(),
        ]);

        // create unique index
        $this->createIndex('idx-prices-unique', 'prices', ['month_id', 'tonnage_id', 'raw_type_id'], true);

        // add foreign keys
        $this->addForeignKey('fk-prices-month_id', 'prices', 'month_id', 'months', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk-prices-tonnage_id', 'prices', 'tonnage_id', 'tonnages', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk-prices-raw_type_id', 'prices', 'raw_type_id', 'raw_types', 'id', 'CASCADE', 'NO ACTION');
    }

    public function safeDown()
    {
        // drop foreign keys
        $this->dropForeignKey('fk-prices-raw_type_id', 'prices');
        $this->dropForeignKey('fk-prices-tonnage_id', 'prices');
        $this->dropForeignKey('fk-prices-month_id', 'prices');
        
        // drop the table
        $this->dropTable('prices');
    }
}
