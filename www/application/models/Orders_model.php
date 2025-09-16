<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders_model extends CI_Model
{
    public function get($start_date, $end_date, $page = 1, $total_records = false ,$rows_per_page = 5, $filters = [], $search_text="")
    {
        if( (empty($page)) || ($page <= 0) ) $page =1;
        $offset = ( ($page-1)*$rows_per_page);  

        if (empty($start_date)) $start_date = date("Y-m-01");
        if (empty($end_date)) $end_date = date("Y-m-t");

        $this->db->select("o.*
            , u.name as agent
            , cu.customer_code, cu.title, cu.first_name, cu.last_name, cu.nic, cu.address, cu.city, cu.phone_number1, cu.phone_number2, cu.email, cu.discount as customerDiscount
            ")
            ->from("orders o")
            ->join("customers cu","cu.customer_id=o.customer_id","left")
            ->join("users u","u.id=o.created_by","left")
            ->where("o.status","1");
        if(!empty($start_date)) $this->db->where('DATE(order_date) >= ', $start_date);
        if(!empty($end_date)) $this->db->where('DATE(order_date) <= ', $end_date);
        if(!empty($search_text)){
            $this->db->group_start();
            $this->db->like("o.document_number",$search_text);
            $this->db->or_like("cu.first_name",$search_text);
            $this->db->or_like("cu.last_name",$search_text);
            $this->db->or_like("u.name",$search_text);
            $this->db->group_end();
        }
        if($_SESSION['user_level'] == 'Normal'){
            $this->db->where("o.created_by",$_SESSION['user_id']);
        }

        $this->db->order_by("o.order_date","desc");
    
        if(!$total_records){
            $this->db->limit($rows_per_page,$offset);
            // $this->db->limit(5,2);
            $result = $this->db->get()->result();
            return $result;
        }
        $result = $this->db->get()->result();
        return count($result);
        
    }

    public function total_records($start_date, $end_date,$search_text)
    {
        return $this->get($start_date, $end_date, "", true, 0,[],$search_text);
    }

    public function fetchAllProducts()
    {
        return $this->db->select('product_id as id,stockref as name')
            ->from('products')
            ->where('status', '1')
            ->get()
            ->result();
    }

    public function fetchAllRoutes()
    {
        return $this->db->select('route_id as id,description as name')
            ->from('routes')
            //->where('status', '1')
            ->get()
            ->result();
    }

    public function getByUuid($uuid)
    {
        $order = $this->db->select("o.*
                    , u.name as agent
                    , CONCAT(cu.last_name,' ',cu.first_name) as customerName, cu.customer_code, cu.title, cu.first_name, cu.last_name, cu.nic, cu.address, cu.city, cu.phone_number1, cu.phone_number2, cu.email, cu.discount as customerDiscount
                    , pm.name paymentMode
                    ")
                    ->from("orders o")
                    ->join("customers cu","cu.customer_id=o.customer_id","left")
                    ->join("users u","u.id=o.created_by","left")
                    ->join("payment_modes pm","pm.id=o.payment_mode_id","left")
                    ->where(["o.status"=>"1","o.uuid"=>$uuid])
                    ->get()
                    ->row();
        if(!empty($order)){
            $order->rows = $this->db->select("od.*
                        , p.name productName, p.type productType
                        , pc.name category
                    ")
                    ->from("order_details od")
                    ->join("products p","p.id=od.product_id","left")
                    ->join("product_categories pc","pc.id=p.category_id","left")
                    ->where("od.order_id",$order->id)
                    ->get()
                    ->result();
        }
        return $order;
    }

    public function getByUuidObj($uuid)
    {
        $order = $this->db->select("o.*
                , st.name as stage
                ")
                ->from("orders o")
                ->join("stages st","st.id=o.stage_id")
                ->where(["o.status"=>"1","o.uuid"=>$uuid])->get()->row();

            if(!empty($order)){
            $order->rows = $this->db
                        ->select("od.*, 
                        , p.photo as productPhoto, p.stockref as productStockRef,p.name as productName, p.description productDescription
                        , pc.name as productCategory
                        , v.name as vetementName, v.image vetementPhoto
                        ")
                        ->from("order_details od")
                        ->join("products p","p.id=od.product_id","left")
                        ->join("vetements v","v.id=p.vetement_id","left")
                        ->join("product_categories pc","pc.id=v.category_id","left")
                        ->where("order_id",$order->id)->get()->result();
            // foreach($order->rows as $i => $r){
            //     $order->rows[$i]->measurements = json_decode($r->measurements);
            // }
            $order->customer = $this->db->from("customers")->where("customer_id",$order->customer_id)->get()->row();
            $order->agent = $this->db->from("users")->where("id",$order->created_by)->get()->row();
            $order->store = $this->db->from("departments")->where("id",$order->delivery_store_id)->get()->row();
            $order->comments = $this->db->from("orders_comments")->where("order_id",$order->id)->get()->row();
        }
        return $order;
    }

    public function getByCustomerId($id)
    {
        $result = $this->db->select("o.*
                    , u.name as agent
                    , od.product_id,od.quantity,od.price,od.measurements
                    , cu.customer_code, cu.title, cu.first_name, cu.last_name, cu.nic, cu.nationality, cu.profession, cu.fidelity_card, cu.address, cu.city, cu.phone_number1, cu.phone_number2, cu.email, cu.discount as customerDiscount
                    , p.photo as productPhoto, p.stockref as productStockRef,p.name as productName, p.description productDescription
                    , st.name as stage
                    , pc.name as productCategory
                    , v.name as vetementName, v.image vetementPhoto
                    , dp.name deliveryStore
                    ")
                    ->from("orders o")
                    ->join("order_details od","od.order_id=o.id","left")
                    ->join("customers cu","cu.customer_id=o.customer_id","left")
                    ->join("stages st","st.id=o.stage_id")
                    ->join("products p","p.id=od.product_id","left")
                    ->join("users u","u.id=o.created_by","left")
                    ->join("vetements v","v.id=p.vetement_id","left")
                    ->join("product_categories pc","pc.id=v.category_id","left")
                    ->join("departments dp","dp.id=o.delivery_store_id","left")
                    ->where(["o.status"=>"1","cu.id"=>$id])
                    ->get()
                    ->result();

        $result->measurements = json_decode($result->measurements);
        return $result;
    }

    public function getSalesById($id)
    {
        $sale = $this->db->select("s.*, r.name region, rr.sequence")
                            ->from("sales s")
                            ->join('routes_regions rr', 's.region_id = rr.region_id', 'left')
                            ->join('regions r', 's.region_id = r.id', "left")
                            ->where("s.id", $id)
                            ->get()->row();

        $sale->sale_details = $this->db->select("sd.id as saledetails_id
                                                    ,sd.uuid as saledetails_uuid
                                                    ,sd.sale_id,p.product_id
                                                    ,sd.price,p.product_name
                                                    ,p.stockref
                                                    ,sd.quantity,sd.description
                                                    ,sd.discount
                                                    ,sd.total")
                                        ->from("sales_details sd")
                                        ->join('products p', 'p.product_id=sd.product_id')
                                        ->where("sd.sale_id", $sale->id)
                                        ->get()->result();

        return $sale;
    }

    public function getProductDetails($id)
    {

        $this->db->select('p.selling_price,p.delivery_fee,pc.category_name');
        $this->db->join('product_category pc', 'pc.product_category_id = p.fk_category_id', 'inner');
        $this->db->where("p.id", $id);
        $query =  $this->db->get("products p");
        $result = $query->result();

        return $result;
    }

    public function save()
    {
        $data = $this->input->post();
        // debug($data);
        $data['documentnumber'] = getDocumentNumber("sales");
        $uuid = gen_uuid();
        $msg = "";
        $valid = true;

        $total = 0;
        foreach($data['rows'] as $row){
            $total += (floatval($row['price']) * floatval($row['quantity']));
        }

        $this->db->set("uuid",$uuid);
        $this->db->set("created_date","NOW()",false);
        $this->db->set("created_by",$_SESSION['user_id']);
        $this->db->set("customer_id",!empty($data['customer_id'])?$data['customer_id']:null);
        $this->db->set("order_date","NOW()",false);
        $this->db->set("amount",$total);
        $this->db->set("payment_mode_id",$data['payment_mode_id']);
        $this->db->set("discount",0);
        $this->db->set("document_number",$data['documentnumber']);
        $this->db->set("department_id",$_SESSION['department_id']);
        $this->db->set("table_number",$data['table_number']);
        
        $this->db->insert("orders");

        $id = $this->db->insert_id();

        foreach($data['rows'] as $row){
            $this->db->set("order_id",$id);
            $this->db->set("product_id",$row['id']);
            $this->db->set("quantity",floatval($row['quantity']));
            $this->db->set("price",floatval($row['price']));
            $this->db->insert("order_details");
        }

        // $this->load->model("Email_model");
        // $this->Email_model->processOrder($initialStage,$data);

        // $this->load->model("messages_model");

        // $this->load->model("system_model");
        // $notifications = json_decode($this->system_model->getParam("notifications"));

        // if(empty($notifications)) return;

        // foreach($notifications as $n){
        //     if($n->stage == $initialStage->id){
        //         $user = $this->db->select("id,email,name,username")->from("users")->where(["status"=>1,"id"=>$n->user])->get()->row();
        //         $this->messages_model->save($initialStage,$user->id,$data['documentnumber']." has been created","HELLO",$id);
        //     }
        // }

        return array(
            'id'                =>  $id,
            'uuid'              =>  $uuid,
            'document_number'   =>  $data['documentnumber'],
            'affected_rows'     =>  $this->db->affected_rows()
        );
    }

    public function update()
    {
        $data = $this->input->post();
        $msg = "";
        $valid = true;

        $this->db->set("customer_id",$data['customer_id']);
        $this->db->set("amount",$data['amount']);
        $this->db->set("discount",$data['discount']);
        $this->db->set("deposit",$data['deposit']);
        $this->db->set("delivery_datetime",$data['delivery_date']." ".$data['delivery_time']);
        $this->db->set("delivery_store_id",$data['delivery_store']);
        $this->db->where("uuid",$data['uuid']);
        $this->db->update("orders");
        return array('affected_rows' =>  $this->db->affected_rows());
    }

    public function delete($uuid)
    {
        $this->db->trans_start();

            $x = $this->db->where('o.uuid', $uuid)
                ->from('orders o')
                ->join('order_details od', 'od.order_id = o.id', 'left')
                ->get()->result();

            $this->db->set("status", 0)
                        ->where("uuid", $uuid)
                        ->update("orders");

            // foreach($x as $thisSale){
            //     $this->inventory_model->ProductQtyUpdate($thisSale->product_id, $thisSale->quantity * - 1, 'sales', $thisSale->dept_id);
            // }

        $this->db->trans_complete(); 
    }

    public function getcntSalesRouteIds($route_ids)
    {

        $this->db->select('count(id) AS ct ,id');
        $this->db->where('route_id', $route_ids);
        $this->db->where('status', 1);
        $this->db->group_by('id');
        $query =  $this->db->get("sales");
        $result = $query->result();

        return $result;
    }

    public function getSalesByRouteIds($route_ids)
    {
        if ($route_ids != null)
            $rids = implode(',', $route_ids);
        else
            $rids = 0;
        
        $this->db->select('
                s.id, 
                s.invoice_date, 
                s.document_number, 
                s.total, 
                sd.description,
                sd.quantity,
                sd.price,
                sd.total,
                c.first_name, 
                c.last_name, 
                r.name region, 
                rr.sequence');
        $this->db->from("sales s");
        $this->db->join("sales_details sd","sd.sale_id=s.id","left");
        $this->db->join('customers c', 's.customer_id = c.customer_id', 'inner');
        $this->db->join('routes_regions rr', 's.region_id = rr.region_id', 'inner');
        $this->db->join('regions r', 's.region_id = r.id');
        $this->db->where('rr.route_id in (' . $rids . ')');
        $this->db->where('s.status', 1);
        $this->db->where('mod(s.delivery, 2) = ', 0);
        $query =  $this->db->get();
        $result = $query->result();

        //RegionsWithoutRoutes 
        if (strpos($rids, '-1') !== false){
            $this->db->select('
                s.id, 
                s.invoice_date, 
                s.document_number, 
                s.total, 
                sd.description,
                sd.quantity,
                sd.price,
                sd.total,
                c.first_name, 
                c.last_name, 
                r.name region, 
                rr.sequence');
            $this->db->from("sales s");
            $this->db->join("sales_details sd","sd.sale_id=s.id","left");
            $this->db->join('customers c', 's.customer_id = c.customer_id', 'inner');
            $this->db->join('routes_regions rr', 's.region_id = rr.region_id', 'left');
            $this->db->join('regions r', 's.region_id = r.id');
            $this->db->where('s.status', 1);
            $this->db->where("r.status", 1);
            $this->db->where('mod(s.delivery, 2) = ', 0);
            $this->db->where("rr.id is null");
            $query =  $this->db->get();
            $SalesWizNoRoutes = $query->result();

            foreach($SalesWizNoRoutes as $s) {
                array_push($result, $s);
            }  
            
            $this->db->select('
                s.id, 
                s.invoice_date, 
                s.document_number, 
                s.total, 
                sd.description,
                sd.quantity,
                sd.price,
                sd.total,
                c.first_name, 
                c.last_name, 
                r.name region, 
                rr.sequence');
            $this->db->from("sales s");
            $this->db->join("sales_details sd","sd.sale_id=s.id","left");
            $this->db->join('customers c', 's.customer_id = c.customer_id', 'inner');
            $this->db->join('routes_regions rr', 's.region_id = rr.region_id', 'left');
            $this->db->join('regions r', 's.region_id = r.id');
            $this->db->join('routes r1', 'rr.route_id = r1.route_id', 'inner');
            $this->db->where('s.status', 1);
            $this->db->where("r.status", 1);
            $this->db->where('mod(s.delivery, 2) = ', 0);
            $this->db->where("r1.status", 0);
            $query =  $this->db->get();
            $SalesWizNoRoutes = $query->result();

            foreach($SalesWizNoRoutes as $s) {
                array_push($result, $s);
            } 
        }

        return $result;
    }

    public function getSummary()
    {
        $qry = "SELECT COUNT(o.id) AS mode, o.stage_id AS id, st.name, st.image FROM orders o JOIN stages st ON st.id = o.stage_id WHERE o.status = 1 GROUP BY stage_id";
        return $this->db->query($qry)->result();
    }

    public function recent($qty=10)
    {

        return $this->db->select("o.*,c.title,c.last_name,c.first_name")
                ->from("orders o")
                ->join("customers c","c.customer_id=o.customer_id","left")
                ->join("users u","u.id=o.created_by")
                ->where("o.status","1")
                ->limit($qty)
                ->order_by("o.order_date","desc")
                ->get()
                ->result();
    }

    public function saveRemarks($remarks,$id)
    {
        $this->db->set("uuid",gen_uuid());
        $this->db->set("order_id",$id);
        $this->db->set("created_on","NOW()",FALSE);
        $this->db->set("created_by",$_SESSION['user_id']);
        $this->db->set("remarks",$remarks);
        $this->db->set("marked_out","0");
        $this->db->set("status","1");
        $this->db->insert("orders_remarks");
    }

    public function saveComments($comments,$id)
    {
        $this->db->set("uuid",gen_uuid());
        $this->db->set("order_id",$id);
        $this->db->set("created_on","NOW()",FALSE);
        $this->db->set("created_by",$_SESSION['user_id']);
        $this->db->set("comments",$comments);
        $this->db->set("marked_out","0");
        $this->db->set("status","1");
        $this->db->insert("orders_comments");

        return $this->db->select("oc.*,u.name userName")
                ->from("orders_comments oc")
                ->join("users u","u.id=oc.created_by","left")
                ->where("oc.order_id",$id)
                ->get()->result();
    }
}
