<?php

class Migration_Payment_mode extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `orders` ADD COLUMN `payment_mode_id` INT NOT NULL DEFAULT 1 AFTER `amount`");

    }

    public function down()
    {
        $this->db->query("ALTER TABLE `orders` DROP `payment_mode_id`");
    }
}