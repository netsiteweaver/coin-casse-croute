<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{

    public function get($uuid="",$page="",$rows_per_page="",$search_text="",$category_id="",$type="product")
    {
        if(empty($uuid)){
            $this->db->select("p.*,pc.name category_name, u.name agent");
            $this->db->from("products p");
            $this->db->join("product_categories pc","pc.id=p.category_id","left");
            $this->db->join("users u","u.id=p.created_by","left");
            // $this->db->select("c.*,u.name agent");
            // $this->db->from("customers c");
            // $this->db->join("users u","u.id=c.created_by","left");
            
            $page = (empty($page))?1:$page;
            if(!empty($search_text)){
                $this->db->group_start();
                $this->db->like("p.stockref",$search_text);
                $this->db->or_like("p.name",$search_text);
                $this->db->or_like("pc.name",$search_text);
                $this->db->group_end();
                // $page = 1;
            }else{
                // $page = (empty($page))?1:$page;
            }
            $offset = (intval($page)-1) * intval($rows_per_page);
            $this->db->where(array("p.status"=>'1',"p.type"=>$type));
            if(!empty($category_id)) $this->db->where("p.category_id",$category_id);
            $this->db->limit($rows_per_page,$offset);
            $this->db->order_by("p.display_order, p.name");
            $query = $this->db->get();
            return $query->result();
        }else{
            $this->db->select("p.*,pc.name category_name,  u.name agent");
            $this->db->from("products p");
            $this->db->join("product_categories pc","pc.id=p.category_id","left");
            $this->db->join("users u","u.id=p.created_by","left");
            $this->db->where(array("p.uuid"=>$uuid,"p.status"=>'1'));
            $query = $this->db->get();
            $result = $query->row();
            return $result;
        }
    }

    public function getAll()
    {
        $this->db->select("p.*,pc.name category_name, u.name agent");
        $this->db->from("products p");
        $this->db->join("product_categories pc","pc.id=p.category_id","left");
        $this->db->join("users u","u.id=p.created_by","left");
        $this->db->where(array("p.status"=>'1'));
        $this->db->order_by("p.display_order, p.name");
        $query = $this->db->get();
        return $query->result();
    }

    public function total_records($search_text="")
    {
        $this->db->select("count(p.id) as ct")
                ->from("products p")
                ->join("product_categories pc","pc.id=p.category_id","left")
                ->where("p.status","1");
        if(!empty($search_text)){
            $this->db->group_start();
            $this->db->like("p.stockref",$search_text);
            $this->db->or_like("p.name",$search_text);
            $this->db->or_like("pc.name",$search_text);
            $this->db->group_end();
        }
        return $this->db->get()->row("ct");
    }

    public function save()
    {
        $this->load->model("files_model");
        $images = $this->files_model->uploadImages('photos','uploads/products');

        if(!empty($this->input->post("deleted_image"))){
            $filename = realpath('.') . "/uploads/products/" . basename($this->input->post("deleted_image"));
            if(file_exists($filename)){
                unlink($filename);
            }
            $this->db->set("photo","");
        }

        $this->db->set("name",trim($_POST['name']));
        $this->db->set("description",strtoupper(trim($_POST['description'])));
        $this->db->set("cost_price",$_POST['cost_price']);
        $this->db->set("selling_price",$_POST['selling_price']);
        $this->db->set("vat",$_POST['vat']);
        $this->db->set("category_id",$_POST['category_id']);
        if(!empty($images['filesUploaded'])) $this->db->set("photo",$images['filesUploaded'][0]);
        if(!empty($this->input->post("uuid"))){
            $this->db->where("uuid",$this->input->post("uuid"));
            $this->db->update("products");
        }else{
            $this->db->set("uuid",gen_uuid());
            $this->db->set("stockref",getDocumentNumber("product"));
            $this->db->set("created_by",$_SESSION['user_id']);
            $this->db->set("created_date","NOW()",FALSE);
            $this->db->set("display_order",'1');
            $this->db->insert("products");
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

    public function getByCategory($id)
    {
        $this->db->select("p.*,pc.name category_name,u.name agent");
        $this->db->from("products p");
        $this->db->join("product_categories pc","pc.id=p.category_id","left");
        $this->db->join("users u","u.id=p.created_by","left");
        $this->db->where("p.category_id",$id);
        $this->db->where("p.status","1");
        $this->db->order_by("p.display_order, p.name");
        return $this->db->get()->result();
    }

    public function recent($qty=10,$type="product")
    {
        return $this->db->select("p.*,u.name as agent")
                    ->from("products p")
                    ->join("users u","u.id=p.created_by","left")
                    ->where(array("p.status"=>"1","p.type"=>$type))
                    ->limit($qty)
                    ->order_by("p.created_date","desc")
                    ->get()
                    ->result();
    }
}
