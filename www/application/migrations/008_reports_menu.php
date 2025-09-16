<?php

class Migration_Reports_menu extends CI_Migration
{
    public function up()
    {
        $currentPosition = $this->db->select("MAX(display_order) AS maxId")->from("menu")->where(array("parent_menu"=>0,"visible"=>1))->get()->row("maxId");
        $this->db->query("INSERT INTO `menu` (`id`, `type`, `nom`, `controller`, `action`, `params`, `url`, `class`, `display_order`, `parent_menu`, `visible`, `Normal`, `Admin`, `Root`, `module`, `status`, `backoffice`) VALUES
        (null, 'menu', 'Reports', 'reports', '', NULL, NULL, 'fa-list', $currentPosition, 0, 1, 0, 1, 1, 0, 1, 1)");
        $newId=$this->db->insert_id();
        $this->db->query("INSERT INTO `menu` (`id`, `type`, `nom`, `controller`, `action`, `params`, `url`, `class`, `display_order`, `parent_menu`, `visible`, `Normal`, `Admin`, `Root`, `module`, `status`, `backoffice`) VALUES
        (null, 'menu', 'Selector', 'reports', 'index', NULL, NULL, 'fa-list', 10, 0, 0, 0, 1, 1, 0, 1, 1),
        (null, 'menu', 'Orders', 'reports', 'orders', NULL, NULL, 'fa-list', 10, $newId, 1, 0, 1, 1, 0, 1, 1),
        (null, 'menu', 'Products', 'reports', 'products', NULL, NULL, 'fa-list', 20, $newId, 1, 0, 1, 1, 0, 1, 1);");

        $this->db->set("value","0.65")->where("title","current_version")->update("params");
    }

    public function down()
    {
        $this->db->where("controller","reports")->delete("menu");
    }
}