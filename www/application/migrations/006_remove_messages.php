<?php

class Migration_Remove_messages extends CI_Migration
{
    public function up()
    {
        $result = $this->db->select("*")->from("menu")->where("controller","messages")->get()->result();
        foreach($result as $r){
            $this->db->where("menu_id",$r->id)->delete("permissions");
        }
        $this->db->query("DELETE FROM menu WHERE controller = 'messages'");
        $this->db->query("DROP TABLE `messages`");
    }

    public function down()
    {
        
    }
}