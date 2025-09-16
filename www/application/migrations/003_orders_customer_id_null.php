<?php

class Migration_Orders_customer_id_null extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `orders` CHANGE `customer_id` `customer_id` INT NULL; ");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `orders` CHANGE `customer_id` `customer_id` INT NOT NULL; ");
    }
}