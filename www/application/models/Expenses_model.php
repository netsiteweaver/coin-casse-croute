<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends CI_Model
{

	public function get(INT $page=1,INT $per_page=2,$date_start="",$date_end="")
	{
        if( (empty($page)) || ($page <= 0) ) $page =1;
        $offset = ( ($page-1)*$per_page);  

		$this->db->select("*");
		$this->db->from("expenses");
		$this->db->where(array("status"=>"1"));
		if(!empty($date_start)) $this->db->where("expenses_date >=",$date_start." 00:00:00");
		if(!empty($date_end)) $this->db->where("expenses_date <=",$date_end." 23:59:59");
		$this->db->limit($per_page,$offset);
		$this->db->order_by("expenses_date, id","desc");
		return $this->db->get()->result();
	}

    public function getSummary()
    {
        $total = $this->db->select('SUM(amount) AS total')->from("expenses")->where(array("expenses_date" => date('Y-m-d'), "status" => '1'))->get()->row('total');
		return floatval($total);
    }

	public function total_records()
	{
		$this->db->select("count(id) AS ct");
		$this->db->from("expenses");
		$this->db->where(array("status"=>"1"));
		return $this->db->get()->row('ct');
	}

	public function getSingle($uuid)
	{
		$this->db->select("*");
		$this->db->from("expenses");
		$this->db->where(array("status"=>"1","uuid"=>$uuid));
		return $this->db->get()->row();
	}

	public function save()
	{
		$uuid = $this->input->post("uuid");
		$expenses_date = $this->input->post("expenses_date");
		$description = $this->input->post("description");
		$amount = $this->input->post("amount");

		$this->db->set('expenses_date',$expenses_date);
		$this->db->set('description',$description);
		$this->db->set('amount',$amount);

		if(empty($uuid)){
			$this->db->set('uuid',gen_uuid());
			$this->db->set('created_by',$_SESSION['user_id']);
			$this->db->set('created_on',"NOW()",false);
			$this->db->insert('expenses');
		}else{
			$this->db->where("uuid",$uuid);
			$this->db->update('expenses');
		}
	}


    
}