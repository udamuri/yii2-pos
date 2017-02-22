<?php

use yii\db\Migration;

class m170217_085342_tbl_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tbl_product}}', [
            'product_id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull()->defaultValue(0),
            'product_barcode' => $this->string(255)->unique()->notNull(),
            'product_name' => $this->string(150)->notNull(),
            'product_location' => $this->string(50),
            'product_sale_price' => $this->double()->notNull(),
            'product_sale_discount' => $this->double()->notNull(),
            'product_status' => $this->smallInteger()->notNull()->defaultValue(1),
            'product_created_at' => $this->datetime()->notNull(),
            'product_updated_at' => $this->datetime()->notNull(),
            'userid' => $this->integer(11)->notNull(),
        ], $tableOptions);    
    }

    public function down()
    {
        $this->dropTable('{{%tbl_product}}');
    }
}
