<?php

class Migration_Orders extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `orders` DROP `delivery_store_id`, DROP `trial_date`, DROP `deposit`, ADD COLUMN `customer_details` JSON NULL");

    }

    public function down()
    {
        $this->db->query("ALTER TABLE `orders` 
                            ADD COLUMN `delivery_store_id` INT NOT NULL AFTER `status`, 
                            ADD COLUMN `trial_date` DATETIME NULL AFTER `department_id`, 
                            ADD COLUMN `deposit` FLOAT NOT NULL AFTER `discount`");
    }
}