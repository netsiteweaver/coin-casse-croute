<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Countries_model extends CI_Model{

    public function getAll($offset=0,$rows=25)
    {
        $this->db->order_by("country");
        $query =$this->db->get("tblcountry");//,$rows,$offset);
        $result = $query->result();
        return $result;

    }


    public function getById($id)
    {
        $this->db->where("id","$id");
        return $this->db->get("tblcountry")->row();
    }

    public function update($data)
    {
        $this->db->where("id",$data['id']);
        $this->db->set('country',$data['country']);

        $this->db->update('tblcountry');

    }

    public function save($data)
    {
        $this->db->set('country',$data['country']);

        $this->db->insert('tblcountry');
    }

    public function delete($id)
    {

        $this->db->where("id",$id);
        $this->db->delete('tblcountry');

    }    


}