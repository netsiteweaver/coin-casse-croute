<?php

class Location_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->from('locations')->where('status',1)->get()->result();
    }

    public function getById($id)
    {
        return $this->db->where(array('id'=>$id,'status'=>1))->from('locations')->get()->row();
    }
}