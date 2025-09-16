<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model{

    /*public function get($fields="")
    {
        if(!empty($fields)){
            if(is_array($fields)){
                $allfields = "";
                foreach($fields as $field){
                    $allfields .= $field . ',';
                }
                $allfields = substr($allfields, 0, strlen($allfields)-1);
                $this->db->select($allfields);
            }else{
                $this->db->select($fields);
            }
        }
        return $this->db->get("company")->row();
    }*/

    public function getAll($offset=0,$rows=25)
    {
        $this->db->select('*, tblvehicle.id vid, tblvehiclemodel.model model, tblvehiclemake.make make, tblvehiclecolor.color color, tblvehicle.status_id status_id, tblstatus.status status, tblvehiclephoto.photo_location photo, tblvehiclephoto.thumb_location thumbnail');
        $this->db->join('tblvehiclemodel','tblvehiclemodel.id = tblvehicle.model_id','left');
        $this->db->join('tblvehiclemake','tblvehiclemake.id = tblvehiclemodel.make_id','left');
        $this->db->join('tblvehiclecolor','tblvehiclecolor.id = tblvehicle.color_id','left');
        $this->db->join('tblvehicletransmission','tblvehicletransmission.id = tblvehicle.transmission_id','left');
        $this->db->join('tblstatus','tblstatus.id = tblvehicle.status_id','left');
        $this->db->join('tblvehiclephoto','tblvehiclephoto.vehicle_id = tblvehicle.id','left');
        $this->db->where("tblvehiclephoto.default_image","1");
        $this->db->order_by("created_date","desc");

        $query =$this->db->get("tblvehicle",$rows,$offset);
        $result = $query->result();
        return $result;

    }

    public function countAll()
    {
        $this->db->select("status");
        $statuses = $this->db->get("tblstatus")->result();

        $count['Total'] = $this->db->count_all_results('tblvehicle');
        foreach($statuses as $status){
            $this->db->join("tblstatus","tblstatus.id = tblvehicle.status_id");
            $this->db->where('tblstatus.status',$status->status);
            $count[$status->status] = $this->db->count_all_results('tblvehicle');
        }

        return $count;
    }

    public function getById($id)
    {
        $this->db->where("id","$id");
        return $this->db->get("locations")->row();
    }

    public function saveCompany($data)
    {
        $this->db->update("company",$data);
    }

}