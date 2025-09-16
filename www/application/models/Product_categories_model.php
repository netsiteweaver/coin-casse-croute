<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_categories_model extends CI_Model
{
    public function get($uuid="")
    {
        $this->db->select("*");
        $this->db->from("product_categories");
        if(!empty($uuid)) $this->db->where("uuid",$uuid);
        $this->db->where("status","1")->order_by("display_order, name");
        return $this->db->get()->result();
    }

    public function save()
    {
        $this->load->model("files_model");
        $images = $this->files_model->uploadImages('photo','uploads/product_categories');
        $this->db->set('name',$_POST['name']);
        $this->db->set("display_order",$_POST['display_order']);
        if(!empty($images['filesUploaded'])) $this->db->set("photo",$images['filesUploaded'][0]);

        if(empty($_POST['uuid'])){
            $this->db->set('uuid',gen_uuid());
            $this->db->set('created_by',$_SESSION['user_id']);
            $this->db->set('created_date',date('Y-m-d H:i:s'));
            $this->db->set('status','1');
            $this->db->insert("product_categories");
        }else{
            $this->db->where('uuid',$_POST['uuid'])->update("product_categories");
        }
    }    
}