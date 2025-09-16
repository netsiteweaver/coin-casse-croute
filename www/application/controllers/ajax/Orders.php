<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function refresh()
    {
        $result = $this->db->select("o.*,CONCAT(c.first_name, ' ', c.last_name) AS client,u.name as agent")
                    ->from("orders o")
                    ->join("users u","u.id=o.created_by","left")
                    ->join("customers c","c.customer_id = o.customer_id","left")
                    ->where(array("o.status"=>'1'))
                    ->limit(5)
                    ->order_by("order_date","desc")
                    ->get()
                    ->result();
        echo json_encode(array("orders"=>$result,"rows"=>count($result),"result"=>true));
    }
}