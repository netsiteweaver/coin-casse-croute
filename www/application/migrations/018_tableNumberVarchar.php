<?php

class Migration_TableNumberVarchar extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `orders` CHANGE `table_number` `table_number` VARCHAR(20) NOT NULL");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `orders` CHANGE `table_number` `table_number` INT NOT NULL");
    }
}