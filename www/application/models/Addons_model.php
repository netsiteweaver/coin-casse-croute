<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Addons_model extends CI_Model
{

    public function get($uuid="",$page="",$rows_per_page="",$search_text="",$category_id="")
    {
        if(empty($uuid)){
            $this->db->select("p.*,u.name agent");
            $this->db->from("products p");
            $this->db->join("users u","u.id=p.created_by","left");
            
            $page = (empty($page))?1:$page;
            if(!empty($search_text)){
                $this->db->group_start();
                $this->db->like("p.stockref",$search_text);
                $this->db->or_like("p.name",$search_text);
                $this->db->group_end();
            }
            $offset = (intval($page)-1) * intval($rows_per_page);
            $this->db->where(array("type"=>"addon","p.status"=>'1'));
            if(!empty($category_id)) $this->db->where("p.category_id",$category_id);
            $this->db->limit($rows_per_page,$offset);
            $this->db->order_by("display_order");
            $query = $this->db->get();
            return $query->result();
        }else{
            $this->db->select("p.*,u.name agent");
            $this->db->from("products p");
            $this->db->join("users u","u.id=p.created_by","left");
            $this->db->where(array("type"=>"addon","p.uuid"=>$uuid,"p.status"=>'1'));
            $query = $this->db->get();
            $result = $query->row();
            if(!empty($result)) {
                $addonsObj = $this->db->select('pc.id')
                                    ->from("addons_categories ac")
                                    ->join("product_categories pc","pc.id=ac.product_category_id")
                                    ->where("ac.addon_id",$result->id)
                                    ->order_by("pc.display_order","desc")
                                    ->get()
                                    ->result();
                $result->addons = array_column($addonsObj,'id');
            }
            return $result;
        }
    }

    public function getAll()
    {
        $this->db->select("p.*,u.name agent");
        $this->db->from("products p");
        $this->db->join("users u","u.id=p.created_by","left");
        $this->db->where(array("p.status"=>'1'));
        $query = $this->db->get();
        return $query->result();
    }

    public function total_records($search_text="")
    {
        $this->db->select("count(p.id) as ct")
                ->from("products p")
                ->where(["p.status"=>"1","p.type"=>"addon"]);
        if(!empty($search_text)){
            $this->db->group_start();
            $this->db->like("p.stockref",$search_text);
            $this->db->or_like("p.name",$search_text);
            $this->db->group_end();
        }
        return $this->db->get()->row("ct");
    }

    public function save()
    {
        $this->load->model("files_model");
        $images = $this->files_model->uploadImages('photos','uploads/addons');
        // debug($images);

        if(!empty($this->input->post("deleted_image"))){
            $filename = realpath('.') . "/uploads/addons/" . basename($this->input->post("deleted_image"));
            if(file_exists($filename)){
                unlink($filename);
            }
            $this->db->set("photo","");
        }

        $this->db->set("name",trim($_POST['name']));
        $this->db->set("cost_price",'1');
        $this->db->set("description",'');
        $this->db->set("type",'addon');
        $this->db->set("selling_price",$_POST['selling_price']);
        $this->db->set("vat",$_POST['vat']);
        if(!empty($images['filesUploaded'])) $this->db->set("photo",$images['filesUploaded'][0]);
        if(!empty($this->input->post("uuid"))){
            $this->db->where("uuid",$this->input->post("uuid"));
            $this->db->update("products");
            $this->updateAddons($this->input->post("uuid"));
        }else{
            $maxId = $this->db->select("MAX(id) AS ct")->from("products")->get()->row("ct");
            $this->db->set("uuid",gen_uuid());
            $this->db->set("stockref",getDocumentNumber("addon"));
            $this->db->set("created_by",$_SESSION['user_id']);
            $this->db->set("created_date","NOW()",FALSE);
            $this->db->set("display_order",(empty($maxId))?'1':$maxId);
            $this->db->insert("products");
            $this->saveAddons($this->db->insert_id());
        }
        
    }

    private function saveAddons($id)
    {
        foreach($this->input->post("addon_category") as $ac){
            $this->db->set("addon_id",$id);
            $this->db->set("product_category_id",$ac);
            $this->db->insert("addons_categories");
        }
    }

    private function updateAddons($uuid)
    {
        $id = $this->db->select("id")->from("products")->where("uuid",$uuid)->get()->row("id");
        $this->db->where("addon_id",$id)->delete("addons_categories");
        foreach($this->input->post("addon_category") as $ac){
            $this->db->set("addon_id",$id);
            $this->db->set("product_category_id",$ac);
            $this->db->insert("addons_categories");
        }
    }

    public function stockRefExists()
    {
        $stockref = $this->input->get("stockref");
        $id = $this->input->get("id");

        $this->db->select("count(id) AS ct");
        $this->db->from("products");
        $this->db->where(array(
            "status"    =>  1,
            "stockref"  =>  $stockref
        ));
        if(!empty($id)){
            $this->db->where("id !=",$id);
        }
        $ct = $this->db->get()->row("ct");
        return ($ct>0) ? true : false;
    }

    public function recent($qty=10)
    {
        return $this->db->select("p.*,u.name as agent")
                    ->from("products p")
                    ->join("users u","u.id=p.created_by","left")
                    ->where("p.status","1")
                    ->limit($qty)
                    ->order_by("p.created_date","desc")
                    ->get()
                    ->result();
    }
}
