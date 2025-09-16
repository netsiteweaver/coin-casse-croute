<?php

class Migration_AddTableToOrders extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `orders` ADD COLUMN `table_number` INT NOT NULL;");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `orders` DROP `table_number`");
    }
}