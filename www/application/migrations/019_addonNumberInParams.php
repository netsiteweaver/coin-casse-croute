<?php

class Migration_AddonNumberInParams extends CI_Migration
{
    public function up()
    {
        $ct = $this->db->query("SELECT count(id) AS ct FROM products where type='addon' and status = '1'")->row("ct");
        $next = intval($ct)+1;
        $this->db->query("INSERT INTO `params` (`id`, `title`, `value`, `status`) VALUES
                                        (null, 'addon_last_number', '".$next."', 1),
                                        (null, 'addon_maxlength', '8', 1),
                                        (null, 'addon_prefix', 'ADD', 1);");
    }

    public function down()
    {
        $this->db->query('DELETE FROM params WHERE `title` LIKE ("addon_%")');
    }
}