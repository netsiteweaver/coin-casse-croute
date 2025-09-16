<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers_model extends CI_Model
{
    public function lookup()
    {
        return $this->db->select("customer_id, CONCAT(title, ' ', last_name, ' ', first_name) name")->from("customers")->where("status","1")->order_by("last_name,first_name")->get()->result();
    }

    public function get($uuid="",$page="",$rows_per_page="",$search_text="",$order_by="last_name",$order_dir="asc")
    {
        if(empty($uuid)){
            $this->db->select("c.*,u.name agent");
            $this->db->from("customers c");
            $this->db->join("users u","u.id=c.created_by","left");
            
            $page = (empty($page))?1:$page;
            if(!empty($search_text)){
                $this->db->group_start();
                $this->db->like("first_name",$search_text);
                $this->db->or_like("last_name",$search_text);
                $this->db->or_like("phone_number1",$search_text);
                $this->db->or_like("phone_number2",$search_text);
                $this->db->or_like("address",$search_text);
                $this->db->or_like("city",$search_text);
                $this->db->or_like("customer_code",$search_text);
                $this->db->group_end();
                // $page = 1;
            }else{
                // $page = (empty($page))?1:$page;
            }
            $offset = ($page-1) * $rows_per_page;
            $this->db->where(array("c.status"=>'1'));
            $this->db->order_by($order_by,$order_dir);
            $this->db->limit($rows_per_page,$offset);
            $query = $this->db->get();
            return $query->result();
        }else{
            $this->db->select("c.*,u.name agent");
            $this->db->from("customers c");
            $this->db->join("users u","u.id=c.created_by","left");
            $this->db->where(array("c.uuid"=>$uuid,"c.status"=>'1'));
            $this->db->order_by($order_by,$order_dir);
            $query = $this->db->get();
            return $query->row();
        }

    }

    public function total_records($search_text="")
    {
        $this->db->select("count(customer_id) as ct")
                ->from("customers")
                ->where("status","1");
        if(!empty($search_text)){
            $this->db->group_start();
            $this->db->like("first_name",$search_text);
            $this->db->or_like("last_name",$search_text);
            $this->db->or_like("phone_number1",$search_text);
            $this->db->or_like("phone_number2",$search_text);
            $this->db->or_like("address",$search_text);
            $this->db->or_like("city",$search_text);
            $this->db->or_like("customer_code",$search_text);
            $this->db->group_end();
        }
        return $this->db->get()->row("ct");
    }

    public function save()
    {
        if( 
            (empty($_POST['first_name'])) || 
            (empty($_POST['last_name']))
        ){
            return array("result"=>false,"reason"=>"First and Last Name is Mandatory");
        }
        $this->db->set("title",$_POST['title']);
        $this->db->set("customer_code",$this->input->post("customer_code"));
        $this->db->set("first_name",$this->input->post("first_name"));
        $this->db->set("last_name",$this->input->post("last_name"));
        $this->db->set("address",$this->input->post("address"));
        $this->db->set("city",$_POST['city']);
        $this->db->set("nic",(!empty($_POST['nic']))?$_POST['nic']:null);
        $this->db->set("dob",$_POST['dob']);
        $this->db->set("remarks",$this->input->post("remarks"));
        $this->db->set("phone_number1",$_POST['phone_number1']);
        $this->db->set("phone_number2",$_POST['phone_number2']);
        $this->db->set("status","1");
        $_POST['id'] = "";
        
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        
        if(empty($this->input->post("uuid"))){
            $uuid = gen_uuid();
            $this->db->set("uuid",gen_uuid());
            $this->db->set("created_by",$_SESSION['user_id']);
            $this->db->set("created_date","NOW()",TRUE);
            $this->db->insert("customers");

            $check = $this->db->error();
            if($check['code']>0){
                return array("result"=>false,"reason"=>$check['message']);
                // echo json_encode(array("result"=>false,"reason"=>$check['message']));
                // exit;
            }
            $_POST['uuid'] = $uuid;
            $_POST['id'] = $this->db->insert_id();
        }else{
            $this->db->where("uuid",$this->input->post("uuid"));
            $this->db->update("customers");
            $check = $this->db->error();
            if($check['code']>0){
                return array("result"=>false,"reason"=>$check['message']);
                // echo json_encode(array("result"=>false,"reason"=>$check['message']));
                // exit;
            }
            $_POST['uuid'] = $this->input->post("uuid");
        }

        $this->db->db_debug = $db_debug;
        return array("result"=>true,"uuid"=>$_POST['uuid'],"id"=>$_POST['id']);
    }

    public function quick_save()
    {
        //first check if a record already exists
        $nic = $_POST['nic'];
        $phone1 = $_POST['phone_number1'];
        $phone2 = $_POST['phone_number2'];

        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $uuid = gen_uuid();
        $this->db->set("uuid",$uuid);
        $this->db->set("title",$_POST['title']);
        $this->db->set("customer_code",$_POST['customer_code']);
        $this->db->set("first_name",$_POST['first_name']);
        $this->db->set("last_name",$_POST['last_name']);
        $this->db->set("address",$_POST['address']);
        $this->db->set("city",$_POST['city']);
        $this->db->set("nic",$_POST['nic']);
        $this->db->set("dob",$_POST['dob']);
        $this->db->set("remarks",$_POST['remarks']);
        $this->db->set("phone_number1",$_POST['phone_number1']);
        $this->db->set("phone_number2",$_POST['phone_number2']);
        $this->db->set("status","1");
        $this->db->set("created_by",$_SESSION['user_id']);
        $this->db->set("created_date","NOW()",TRUE);
        $this->db->insert("customers");

        $this->db->db_debug = $db_debug;

        $error = $this->db->error();
        if($error['code'] != '0'){
            return array("result"=>false,"error_code"=>$error['code'],"error_message"=>$error['message']);
        }
        return array("result"=>true,"uuid"=>$uuid);
    }

    public function fetch($id="",$searchTerm="",$random=false)
    {
        $this->db->select("c.*,u.name agent");
        $this->db->from("customers c");
        $this->db->join("users u","u.id=c.created_by","left");
        if(!empty($id)) $this->db->where("c.customer_id",$id);
        if(!empty($searchTerm)){
            $this->db->group_start();
            $this->db->like("c.customer_code",$searchTerm);
            $this->db->or_like("c.customer_code",$searchTerm);
            $this->db->or_like("c.first_name",$searchTerm);
            $this->db->or_like("c.last_name",$searchTerm);
            $this->db->or_like("c.phone_number1",$searchTerm);
            // $this->db->or_like("c.phone_number2",$searchTerm);
            $this->db->or_like("c.address",$searchTerm);
            $this->db->or_like("c.city",$searchTerm);
            // $this->db->or_like("c.email",$searchTerm);
            $this->db->group_end();
        }
        $this->db->where("c.status","1");
        if($random) $this->db->order_by("rand()")->limit(25);
        return $this->db->get()->result();
    }

    public function getHistory($customer_id,$order_uuid="")
    {
        $this->db->select("o.uuid,o.order_date,o.amount,o.discount,o.deposit,o.delivery_datetime,o.document_number,
                            c.first_name customerFirstName,c.last_name customerLastName,c.customer_code,
                            p.stockref,p.name productName, 
                            d.name deliveryStore,
                            st.name stageName")
                    ->from("orders o")
                    ->join("order_details od","od.order_id=o.id","left")
                    ->join("products p","p.id=od.product_id","left")
                    ->join("customers c","c.customer_id=o.customer_id","left")
                    ->join("departments d","d.id=o.delivery_store_id","left")
                    ->join("stages st","st.id=o.stage_id","left")
                    ->where(["o.status"=>1,"o.customer_id"=>$customer_id]);
        if(!empty($uuid)) $this->db->where("o.uuid",$uuid);
        $orders = $this->db->order_by("o.order_date","desc")
                            ->get()
                            ->result();
        return $orders;
    }

    public function recent($qty=10)
    {
        return $this->db->select("p.*,u.name as agent")
                    ->from("customers p")
                    ->join("users u","u.id=p.created_by","left")
                    ->where(array("p.status"=>"1"))
                    ->limit($qty)
                    ->order_by("p.created_date","desc")
                    ->get()
                    ->result();
    }
}
