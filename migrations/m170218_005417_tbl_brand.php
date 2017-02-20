<?php

use yii\db\Migration;

class m170218_005417_tbl_brand extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tbl_brand}}', [
            'brand_id' => $this->primaryKey(),
            'brand_name' => $this->string(150)->notNull(),
            'brand_status' => $this->smallInteger()->notNull()->defaultValue(1),
            'brand_created_at' => $this->datetime()->notNull(),
            'brand_updated_at' => $this->datetime()->notNull(),
            'userid' => $this->integer(11)->notNull(),
        ], $tableOptions);    
    }

    public function down()
    {
        $this->dropTable('{{%tbl_brand}}');
    }
}
