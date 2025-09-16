<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cities_model extends CI_Model{

    public function getAll()
    {
        
        $this->db->select("tblcity.id cityId, tblcity.city city, tblcountry.id countryId, tblcountry.country country");
        $this->db->join("tblcountry","tblcountry.id = tblcity.country_id","left");
        $this->db->order_by("tblcity.city");
        $query =$this->db->get("tblcity");
        $result = $query->result();
        
        return $result;

    }


    public function getById($id)
    {
        $this->db->select("tblcity.id cityId, tblcity.city city, tblcountry.id countryId, tblcountry.country country");
        $this->db->join("tblcountry","tblcountry.id = tblcity.country_id","left");
        $this->db->where("tblcity.id","$id");
        return $this->db->get("tblcity")->row();
    }

    public function update($data)
    {
        $this->db->where("id",$data['id']);
        $this->db->set('city',$data['city']);
        $this->db->set('country_id',$data['country_id']);

        $this->db->update('tblcity');

    }

    public function save($data)
    {
        $this->db->set('city',$data['city']);
        $this->db->set('country_id',$data['country_id']);

        $this->db->insert('tblcity');
    }    

    public function delete($id)
    {

        $this->db->where("id",$id);
        $this->db->delete('tblcity');

    }

}