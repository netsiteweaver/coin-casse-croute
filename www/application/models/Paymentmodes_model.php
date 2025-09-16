<?php

class Paymentmodes_model extends CI_Model
{

    public function get($uuid="")
    {
        if(empty($uuid)){
            return $this->db->select("*")->from("payment_modes")->where("status","1")->get()->result();
        }else{
            return $this->db->select("*")->from("payment_modes")->where(array("status"=>"1","uuid"=>$uuid))->get()->row();
        }
    }

    public function save()
    {
        $this->db->set("name",$this->input->post("name"));
        $this->db->set("attachment",$this->input->post("attachment"));
        $this->db->set("status","1");
        if(empty($this->input->post("uuid"))){
            $this->db->set("uuid",gen_uuid());
            $this->db->set("created_by",$_SESSION['user_id']);
            $this->db->set("created_date","NOW()",FALSE);
            $this->db->insert("payment_modes");
        }else{
            $this->db->where("uuid",$this->input->post("uuid"))->update("payment_modes");
        }
    }

    public function getPaymentId($Name)
    {
        $this->db->select('id');
        $this->db->from('payment_modes');
        $this->db->where('name', $Name);
        $this->db->where('status', '1');
        $query = $this->db->get()->row("id");

        return $query;
    }

    public function getPaymentName($id)
    {
        $this->db->select('name');
        $this->db->from('payment_modes');
        $this->db->where('id', $id);
        $this->db->where('status', '1');
        $query = $this->db->get()->row("name");

        return $query;
    }
}