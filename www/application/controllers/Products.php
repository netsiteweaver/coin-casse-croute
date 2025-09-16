<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

    public $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['controller']   = str_replace("-","",$this->uri->segment(1,"dashboard"));
        $this->data['method']       = $this->uri->segment(2,"index");

        $this->mybreadcrumb->add('Products', base_url('products/listing'));

        $this->load->model("accesscontrol_model");
        $this->data['perms']['add'] = $this->accesscontrol_model->authorised("products","add");
        $this->data['perms']['edit'] = $this->accesscontrol_model->authorised("products","edit");
        $this->data['perms']['delete'] = $this->accesscontrol_model->authorised("products","delete");

        $this->load->model("products_model");
        $this->load->model("product_categories_model");

    }

    public function get()
    {
        $products = $this->products_model->get();
        echo json_encode(array("result"=>true,"products"=>$products));
        exit;
    }

    public function index()
    {
        redirect(base_url('products/listing'));
    }

    public function add()
    {
        //Access Control
        if(!isAuthorised(get_class(),"add")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Add', base_url('products/add'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Add Product";

        //get product categories
        $this->data['product_categories'] = $this->db->from("product_categories")->where("status","1")->get()->result(); //product_categories_model->get();

        $this->data["content"]=$this->load->view("/products/add",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

    public function save()
    {
        //Access Control
        if(!isAuthorised(get_class(),"add")) return false;

        $result = $this->products_model->save();

        flashSuccess("Product created successfully..");
        redirect(base_url("products/listing"));

    }

    public function stockRefExists()
    {
        $result = $this->products_model->stockRefExists();
        echo json_encode(array("result"=>$result));
    }

    public function edit()
    {
        //Access Control 
        if(!isAuthorised(get_class(),"edit")) return false;

        $uuid = $this->uri->segment(3);
        $this->data['product'] = $this->products_model->get($uuid);
        if(empty($this->data['product'])){
            redirect(base_url("products/listing"));
        }

        //Breadcrumbs
        $this->mybreadcrumb->add('Edit', base_url('products/edit'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Edit Product";

        //get product categories
        $this->data['product_categories'] = $this->db->from("product_categories")->where("status","1")->order_by("name")->get()->result();

        $this->data["content"]=$this->load->view("/products/edit",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

    public function listing()
    {
        //Access Control        
        if(!isAuthorised(get_class(),"listing")) return false;

        $this->load->model("system_model");
        $this->data['rows_per_page'] = empty($this->input->get("display"))?$this->system_model->getParam("rows_per_page"):$this->input->get("display");
        $page = $this->uri->segment(3, '1');

        $this->data['products'] = $this->products_model->get(null,$page,$this->data['rows_per_page'],$this->input->get('search_text'),$this->input->get("category_id"),"product");
        $total_records = $this->products_model->total_records($this->input->get('search_text'));

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Product Listing";

        $this->data['pagination'] = getPagination("products/listing",$total_records,$this->data['rows_per_page']);

        $this->load->model("product_categories_model");
        $this->data['product_categories'] = $this->product_categories_model->get();

        $this->data["content"]=$this->load->view("/products/listing",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

    public function upload()
    {
        echo 'Processing...';
        $this->load->model("files_model");
        $filename = $this->files_model->uploadCSV("products");

        $categories = [];   $varCat = [];
        $brands = [];       $varBrand = [];
        $colors = [];       $varColor = [];

        if( ($fh=fopen($filename['full_path'],"r")) !== false ){
            fgetcsv($fh, ",");
            while (($data = fgetcsv($fh, ",")) !== FALSE) {
                if(!in_array(strtolower(trim($data[7])),$categories))   $categories[count($categories)+1] = strtolower(trim($data[7]));
                if(!in_array(strtolower(trim($data[8])),$brands))       $brands[count($brands)+1] = strtolower(trim($data[8]));
                if(!in_array(strtolower(trim($data[9])),$colors))       $colors[count($colors)+1] = strtolower(trim($data[9]));
            }

            $this->db->query("SET foreign_key_checks = 0");
            $this->db->query("TRUNCATE `product_category`");
            $this->db->query("TRUNCATE `product_brands`");
            $this->db->query("TRUNCATE `colors`");
            $this->db->query("SET foreign_key_checks = 1");
            
            foreach($categories as $i1 => $category_name){
                $varCat[] = array(
                    'product_category_id'   =>  $i1,
                    'uuid'                  =>  gen_uuid(),
                    'category_name'         =>  ucwords($category_name),
                    'status'                =>  '1',
                    'created_by'            =>  '1',
                    'created_date'          =>  date("Y-m-d H:i:s")
                );
            }

            foreach($brands as $i2 => $brand_name){
                $varBrand[] = array(
                    'product_brand_id'      =>  $i2,
                    'uuid'                  =>  gen_uuid(),
                    'brand_name'            =>  (!empty($brand_name)) ? ucwords($brand_name) : "Default",
                    'status'                =>  '1',
                    'created_by'            =>  '1',
                    'created_date'          =>  date("Y-m-d H:i:s")
                );
            }
            
            foreach($colors as $i3 => $color_name){
                $varColor[] = array(
                    'color_id'              =>  $i3,
                    'uuid'                  =>  gen_uuid(),
                    'color'                 =>  '',
                    'color_name'            =>  ucwords($color_name),
                    'status'                =>  '1',
                    'created_by'            =>  '1',
                    'created_date'          =>  date("Y-m-d H:i:s")
                );
            }

            $this->db->insert_batch("product_category",$varCat);
            $this->db->insert_batch("product_brands",$varBrand);
            $this->db->insert_batch("colors",$varColor);

            fclose($fh);
        }

        if( ($fh=fopen($filename['full_path'],"r")) !== false ){
            fgetcsv($fh, ",");

            $vars = [];
            while (($data = fgetcsv($fh, ",")) !== FALSE) {
                $vars[] = array(
                    "uuid"              =>  gen_uuid(),
                    "stockref"          =>  str_pad($data[0],8,'0',STR_PAD_LEFT),
                    "product_name"      =>  $data[1],
                    "unit_price"        =>  $data[2],
                    "selling_price"     =>  $data[3],
                    "delivery_fee"      =>  $data[4],
                    "size"              =>  $data[5],
                    "compartments"      =>  $data[6],
                    "fk_category_id"    =>  array_search(strtolower($data[7]),$categories),
                    "fk_brand_id"       =>  array_search(strtolower($data[8]),$brands),
                    "fk_color_id"       =>  array_search(strtolower($data[9]),$colors),
                    "created_by"        =>  $_SESSION['user_id'],
                    "created_date"      =>  date("Y-m-d H:i:s")
                );
            }

            fclose($fh);
            $this->db->query("SET foreign_key_checks = 0");
            $this->db->query("TRUNCATE `products`");
            $this->db->query("TRUNCATE `inventory`");
            $this->db->query("SET foreign_key_checks = 1");
            $this->db->insert_batch("products",$vars);

            $this->createInventory();

            flashSuccess("<b>".$filename['orig_name']."</b> has been imported successfully");
            debug($categories,false);
            debug($brands,false);
            debug($colors,false);

            // redirect(base_url('products/listing'));
        }
    }

    private function createInventory()
    {
        $this->load->model("general_model");
        $departments = $this->general_model->lookup("departments");

        $products = $this->db->select("product_id")->from("products")->get()->result();

        foreach ($departments as $department) {
            foreach($products as $product) {
                $this->db->set('uuid', gen_uuid());
                $this->db->set('department_id', $department->id);
                $this->db->set('product_id', $product->product_id);
                $this->db->set('quantity', 0);
                $this->db->set('onorder', 0);
                $this->db->set('reserved', 0);
                $this->db->insert("inventory");
            }
        }
    }

    public function getByCategory()
    {
        $products = $this->products_model->getByCategory($this->input->post("id"));

        echo json_encode(array("result"=>true,"products"=>$products));
        exit;
    }

    public function fetchByUuid()
    {
        $record = $this->products_model->get($this->input->post("uuid"));
        echo json_encode(array(
            "result"    =>  true,
            "record"    =>  $record
        ));
        exit;
    }

    public function fetchAll()
    {
        $rows = $this->products_model->getAll();
        echo json_encode(array(
            "result"    =>  true,
            "rows"      =>  $rows
        ));
        exit;
    }

    public function reorder()
    {
        //Access Control        
        if(!isAuthorised(get_class(),"listing")) return false;

        $this->data['products'] = $this->products_model->getByCategory($this->input->get("category_id"));

        //Breadcrumbs
        $this->mybreadcrumb->add('Reorder Products', base_url('products/reorder'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Reorder Product";

        $this->loadScript("https://code.jquery.com/ui/1.13.2/jquery-ui.js");

        $this->data["content"]=$this->load->view("/products/reorder",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

}