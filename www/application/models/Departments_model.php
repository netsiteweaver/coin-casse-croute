<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Departments_model extends CI_Model{


    public function getAllDepartments()
    {
        $this->db->where("status","1");
        $query =  $this->db->get("departments");
        $result = $query->result();
        return $result;
    }

    public function getDepartmentByUuid($id)
    {
        $this->db->where("uuid","$id");
        return $this->db->get("departments")->row();
    }

    public function save()
    {
        $data = $this->input->post();
        if(empty($data['uuid'])){
            $this->db->set('uuid',gen_uuid());
            $this->db->set('created_by',$_SESSION['user_id']);
            $this->db->set('created_date',date('Y-m-d H:i:s'));
        }
        $this->db->set('name',$data['name']);
        $this->db->set('email',$data['email']);
        $this->db->set('address',$data['address']);
        $this->db->set('phone',$data['phone']);

        if(empty($data['uuid'])){
            $this->db->insert("departments");
        }else{
            $this->db->where('uuid',$data['uuid']);
            $this->db->update('departments');
        }
        return array('result'=>true);
    }    

    public function deleteAjax($uuid)
    {
        $this->db->set("status","0");
        $this->db->where("uuid",$uuid);
        $this->db->update("departments");
    }

  

}