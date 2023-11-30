<?php
use yii\db\Migration;

class m231015_215453_create_table_tonnages extends Migration
{
   /**
    * {@inheritdoc}
    */
   public function safeUp()
   {
       $this->createTable('tonnages', [
        'id' => $this->primaryKey()->unsigned(),
           'value' => $this->tinyInteger(3)->notNull()->unique(),
           'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
           'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull()->append('ON UPDATE CURRENT_TIMESTAMP'),
       ]);

       $this->batchInsert('tonnages', ['value'], [
           [25],
           [50],
           [75],
           [100],
       ]);
   }

   /**
    * {@inheritdoc}
    */
   public function safeDown()
   {
       $this->dropTable('tonnages');
   }
}