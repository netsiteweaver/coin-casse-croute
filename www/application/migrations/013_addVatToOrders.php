<?php

class Migration_AddVatToOrders extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `order_details` ADD COLUMN `vat` ENUM('0','15') NOT NULL DEFAULT '15';");
        $this->db->query("ALTER TABLE `products` ADD COLUMN `vat` ENUM('0','15') NOT NULL DEFAULT '15';");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `orders` DROP `vat`");
    }
}