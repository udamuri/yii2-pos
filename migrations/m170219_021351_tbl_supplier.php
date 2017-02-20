<?php

use yii\db\Migration;

class m170219_021351_tbl_supplier extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tbl_supplier}}', [
            'supplier_id' => $this->primaryKey(),
            'supplier_name' => $this->string(150)->notNull(),
            'supplier_contact_person' => $this->string(100)->notNull(),
            'supplier_address' => $this->string(255),
            'supplier_phone1' => $this->string(20),
            'supplier_phone2' => $this->string(20),
            'supplier_status' => $this->smallInteger()->notNull()->defaultValue(1),
            'supplier_created_at' => $this->datetime()->notNull(),
            'supplier_updated_at' => $this->datetime()->notNull(),
            'userid' => $this->integer(11)->notNull(),
        ], $tableOptions);    
    }

    public function down()
    {
        $this->dropTable('{{%tbl_supplier}}');
    }
}
