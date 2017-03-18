<?php

use yii\db\Migration;

class m170220_123053_tbl_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tbl_item}}', [
            'item_id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->notNull(),
            'product_id' => $this->string(255)->notNull(),
            'item_name' => $this->string(255)->notNull(),  
            'item_price' => $this->double()->notNull(),
            'item_discount' => $this->double()->notNull(),
            'item_unit' => $this->string(255)->notNull(), //satuan  
            'item_unit_qty' => $this->integer(8)->notNull(),  // isi dalam satuan
            'item_qty' => $this->integer(8)->notNull(),
        ], $tableOptions);    
    }

    public function down()
    {
        $this->dropTable('{{%tbl_item}}');
    }
}
