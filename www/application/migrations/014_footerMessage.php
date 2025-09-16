<?php

class Migration_FooterMessage extends CI_Migration
{
    public function up()
    {
        $this->db->query("INSERT INTO `params` VALUES (null,'footer_message','This is a test','1')");
    }

    public function down()
    {
        $this->db->query("DELETE FROM `params` WHERE `title` = 'footer_message`");
    }
}