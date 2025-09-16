<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Channels_model extends CI_Model{


    public function getAllChannels()
    {
        $this->db->where("status","1");
        $query =  $this->db->get("channels");
        $result = $query->result();
    
        return $result;

    }

    public function getChannelByUuid($id)
    {
        $this->db->where("uuid","$id");
        return $this->db->get("channels")->row();
    }


    public function update($data)
    {

        //update Channels details
        $this->db->set('channel_name',$data['channel_name']);
        $this->db->set('remarks',$data['remarks']);
        $this->db->set('logo',($data['image']===null)?"":$data['image']);
        $this->db->where('uuid',$data['uuid']);
        $this->db->update('channels');
       

         return array('result'=>true);
    }

    public function insert($data)
    {
        //save Channels details
        $uuid = gen_uuid();
        $user_id = $_SESSION['user_id'];


        $this->db->set('uuid',$uuid);
        $this->db->set('channel_name',$data['channel_name']);
        $this->db->set('logo',($data['image']===null)?"":$data['image']);
        $this->db->set('remarks',$data['remarks']);
        $this->db->set('created_by',$user_id);
        $this->db->set('created_date',date('Y-m-d H:i:s'));
        $this->db->insert("channels");

        return array('result'=>true);
      
    } 
    
    public function fetchAllChannels()
    {
        return $this->db->select('channel_id as id,channel_name as name')
            ->from('channels')
            ->where('status', '1')
            ->get()
            ->result();
    }




}