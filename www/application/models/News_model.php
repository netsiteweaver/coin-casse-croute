<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model{

    public function getAll()
    {
        $this->db->select('id, newsTitle, date_submitted');
        $this->db->where('status',1);
        $this->db->order_by("date_submitted","desc");
        $query =$this->db->get("tblnews");//,$rows,$offset);
        $result = $query->result();
        return $result;

    }


    public function getById($id)
    {
        $this->db->where("id","$id");
        return $this->db->get("tblnews")->row();
    }

    public function update($data)
    {
        $this->db->where("id",$data['id']);
        $this->db->set('newsTitle',$data['newsTitle']);
        $this->db->set('newsBody',$data['newsBody']);
        $this->db->update('tblnews');

    }

    public function save($data)
    {
        $this->db->set('newsTitle',$data['newsTitle']);
        $this->db->set('newsBody',$data['newsBody']);
        $this->db->insert('tblnews');
    }

    public function delete($id)
    {

        $this->db->where("id",$id);
        $this->db->delete('tblnews');

    }

}