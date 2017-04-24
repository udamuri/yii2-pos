<?php

use yii\db\Migration;

class m170220_123018_tbl_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tbl_order}}', [
            'order_id' => $this->primaryKey(),
            'supplier_id' => $this->integer(11)->notNull(),
            'order_invoice' => $this->string(255)->notNull(),
            'order_date' => $this->date()->notNull(),
            'order_desc' => $this->string(255)->notNull(),
            'order_receive_status' => $this->smallInteger()->notNull()->defaultValue(1), // 1 sell 0 purchase
            'order_type' => $this->smallInteger()->notNull()->defaultValue(1),  // 1 cash 0 credit
            'order_created_at' => $this->datetime()->notNull(),
            'order_updated_at' => $this->datetime()->notNull(),
            'order_discount' => $this->smallInteger(3)->notNull()->defaultValue(0),
            'order_total' => $this->double()->notNull(),
            'userid' => $this->integer(11)->notNull(),
        ], $tableOptions);    
    }

    public function down()
    {
        $this->dropTable('{{%tbl_order}}');
    }
}
