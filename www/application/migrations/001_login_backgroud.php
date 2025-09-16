<?php

class Migration_login_backgroud extends CI_Migration
{
    public function up()
    {
        $this->db->query("INSERT INTO `params` (`id`, `title`, `value`, `status`) VALUES
        (68, 'login_background', '[\r\n{\"image\":\"breakfast-2649620_1920.jpg\"},\r\n{\"image\":\"businesses-2897328_1920.jpg\"},\r\n{\"image\":\"cafe-789635_1920.jpg\"},\r\n{\"image\":\"city-4298285_1920.jpg\"},\r\n{\"image\":\"people-8563622_1920.jpg\"},\r\n{\"image\":\"restaurant-237060_1920.jpg\"}\r\n]', 1);
        ");
    }

    public function down()
    {
        $this->db->query("DELETE FROM `param` WHERE `title` = 'login_background'");
    }
}