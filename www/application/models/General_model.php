<?php

class General_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCount($table,$where=array("status"=>'1'))
    {
        $this->db->select("count(id) AS ct")->from($table);
        $this->db->where($where);
        return $this->db->get()->row("ct");
    }

    public function lookup($table,$where=array("status"=>"1"),$options=array())
    {
        return $this->db->select()
        ->from($table)
        ->where($where)
        ->get()
        ->result();
    }

}