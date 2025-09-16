<?php

class Migration_Remove_fields_order_details extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `order_details`
                            DROP `measurements`,
                            DROP `status`,
                            DROP `fabric_reference`,
                            DROP `fabric_color`,
                            DROP `size`,
                            DROP `additional_fields`");
    }

    public function down()
    {
        
    }
}