<?php

class Migration_Remove_unused_orders_tables extends CI_Migration
{
    public function up()
    {
        $this->db->query("DROP TABLE `orders_comments`, `orders_remarks`, `orders_images`, `order_details_stage_history`");
    }

    public function down()
    {
        
    }
}