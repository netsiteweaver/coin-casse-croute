<?php

class Migration_addons_changed extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `products` ADD COLUMN `type` ENUM('product','addon') NOT NULL DEFAULT 'product'");
        $this->db->query("ALTER TABLE `products` CHANGE `photo` `photo` VARCHAR(50) NULL");
        $this->db->query("ALTER TABLE `products` CHANGE `category_id` `category_id` INT NULL");
        $this->db->set("value","0.67")->where("title","current_version")->update("params");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `products` DROP `type`");
        $this->db->query("ALTER TABLE `products` CHANGE `photo` `photo` VARCHAR(50) NOT NULL");
        $this->db->query("ALTER TABLE `products` CHANGE `category_id` `category_id` INT NOT NULL");
        $this->db->set("value","0.66")->where("title","current_version")->update("params");
    }
}