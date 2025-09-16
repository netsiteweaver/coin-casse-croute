<?php

class Migration_CustomersNicNull extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `customers` CHANGE `nic` `nic` VARCHAR(14) NULL");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `customers` CHANGE `nic` `nic` VARCHAR(14) NOT NULL");
    }
}