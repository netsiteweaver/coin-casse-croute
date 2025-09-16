<?php

class Migration_addons extends CI_Migration
{
    public function up()
    {
        $this->db->query("CREATE TABLE `addons` (
            `id` int NOT NULL AUTO_INCREMENT,
            `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `stockref` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `cost_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `selling_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `photo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `created_by` int DEFAULT NULL,
            `created_date` datetime DEFAULT NULL,
            `display_order` INT NOT NULL,
            `status` tinyint NOT NULL DEFAULT '1',
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB");

        $this->db->query("CREATE TABLE `addons_categories` (
            `addon_id` INT NOT NULL,
            `product_category_id` INT NOT NULL,
            PRIMARY KEY (`addon_id`,`product_category_id`)
        ) ENGINE=InnoDB");
            
        $currentPosition = $this->db->select("MAX(display_order) AS maxId")->from("menu")->where(array("parent_menu"=>0,"visible"=>1))->get()->row("maxId");
        $this->db->query("INSERT INTO `menu` (`id`, `type`, `nom`, `controller`, `action`, `params`, `url`, `class`, `display_order`, `parent_menu`, `visible`, `Normal`, `Admin`, `Root`, `module`, `status`, `backoffice`) VALUES
        (null, 'menu', 'Addons', 'addons', '', NULL, NULL, 'fa-puzzle-piece', $currentPosition, 0, 1, 0, 1, 1, 0, 1, 1)");

        $newId=$this->db->insert_id();
        $this->db->query("INSERT INTO `menu` (`id`, `type`, `nom`, `controller`, `action`, `params`, `url`, `class`, `display_order`, `parent_menu`, `visible`, `Normal`, `Admin`, `Root`, `module`, `status`, `backoffice`) VALUES
        (null, 'menu', 'Listing', 'addons', 'listing', NULL, NULL, 'fa-list', 10, $newId, 1, 0, 1, 1, 0, 1, 1),
        (null, 'menu', 'Add', 'addons', 'add', NULL, NULL, 'fa-plus-square', 10, $newId, 1, 0, 1, 1, 0, 1, 1),
        (null, 'menu', 'Edit', 'addons', 'edit', NULL, NULL, 'fa-list', 10, 0, 0, 0, 1, 1, 0, 1, 1),
        (null, 'menu', 'View', 'addons', 'view', NULL, NULL, 'fa-list', 10, 0, 0, 0, 1, 1, 0, 1, 1),
        (null, 'menu', 'Delete', 'addons', 'delete', NULL, NULL, 'fa-list', 20, 0, 0, 0, 1, 1, 0, 1, 1);");

        $this->db->set("value","0.66")->where("title","current_version")->update("params");
    }

    public function down()
    {
        $this->db->query("DROP TABLE IF EXISTS `addons`");
        $this->db->query("DROP TABLE IF EXISTS `addons_categories`");
        $this->db->where("controller","addons")->delete("menu");
    }
}