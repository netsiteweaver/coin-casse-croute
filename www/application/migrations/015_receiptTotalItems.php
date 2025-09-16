<?php

class Migration_ReceiptTotalItems extends CI_Migration
{
    public function up()
    {
        $this->db->query("INSERT INTO `params` VALUES (null,'total_items','rows','1')");
    }

    public function down()
    {
        $this->db->query("DELETE FROM `params` WHERE `title` = 'footer_message`");
    }
}