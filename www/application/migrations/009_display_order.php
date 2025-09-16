<?php

class Migration_display_order extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `products` ADD COLUMN `display_order` INT NOT NULL DEFAULT '1'");
        $this->db->query("ALTER TABLE `product_categories` ADD COLUMN `display_order` INT NOT NULL DEFAULT '1'");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `products` DROP `display_order`");
        $this->db->query("ALTER TABLE `product_categories` DROP `display_order`");
    }
}