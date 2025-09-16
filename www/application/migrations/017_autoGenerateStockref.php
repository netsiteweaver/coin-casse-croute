<?php

class Migration_AutoGenerateStockref extends CI_Migration
{
    public function up()
    {
        $this->db->query("INSERT INTO `params` (`id`, `title`, `value`, `status`) VALUES (NULL, 'product_last_number', '120', '1'), (NULL, 'product_maxlength', '5', '1'), (NULL, 'product_prefix', '', '1') ");
        $this->db->query("INSERT INTO `params` (`id`, `title`, `value`, `status`) VALUES (NULL, 'addon_last_number', '11', '1'), (NULL, 'addon_maxlength', '5', '1'), (NULL, 'addon_prefix', '', '1') ");
    }

    public function down()
    {
        $this->db->query("DELETE FROM `params` WHERE `title` = 'product_last_number'");
        $this->db->query("DELETE FROM `params` WHERE `title` = 'product_maxlength'");
        $this->db->query("DELETE FROM `params` WHERE `title` = 'product_prefix'");
        $this->db->query("DELETE FROM `params` WHERE `title` = 'addon_last_number'");
        $this->db->query("DELETE FROM `params` WHERE `title` = 'addon_maxlength'");
        $this->db->query("DELETE FROM `params` WHERE `title` = 'addon_prefix'");
    }
}