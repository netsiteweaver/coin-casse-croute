<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_categories extends MY_Controller {

    public $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['controller']   = str_replace("-","",$this->uri->segment(1,"dashboard"));
        $this->data['method']       = $this->uri->segment(2,"index");

        $this->mybreadcrumb->add('Product Categories', base_url('product_categories/listing'));

        $this->load->model("accesscontrol_model");
        $this->data['perms']['add'] = $this->accesscontrol_model->authorised("product_categories","add");
        $this->data['perms']['edit'] = $this->accesscontrol_model->authorised("product_categories","edit");
        $this->data['perms']['delete'] = $this->accesscontrol_model->authorised("product_categories","delete");

        $this->load->model("product_categories_model");

    }

    public function index()
    {
        redirect(base_url('product_categories/listing'));
    }

    public function add()
    {
        //Access Control
        if(!isAuthorised(get_class(),"add")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Add', base_url('product_categories/add'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->data['page_title'] = "Add Category";

        $this->data["content"]=$this->load->view("/product_categories/add",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

    public function save()
    {
        //Access Control
        if(!isAuthorised(get_class(),"add")) return false;
      
        $this->product_categories_model->save();
        flashSuccess("Product Category created successfully..");
        redirect(base_url("product_categories/listing"));

    }


    public function edit()
    {
        //Access Control 
        if(!isAuthorised(get_class(),"edit")) return false;

        $uuid = $this->uri->segment(3);
        $this->data['product_category'] = $this->product_categories_model->get($uuid);
        
        $this->data['page_title'] = "Edit Category";
        //Breadcrumbs
        $this->mybreadcrumb->add('Edit', base_url('product_categories/edit'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->data["content"]=$this->load->view("/product_categories/edit",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

    public function listing()
    {
        //Access Control        
        if(!isAuthorised(get_class(),"listing")) return false;

        $this->data['productcategories'] = $this->product_categories_model->get();

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Product Categories";

        $this->data["content"]=$this->load->view("/product_categories/listing",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

    public function reorder()
    {
        //Access Control        
        if(!isAuthorised(get_class(),"listing")) return false;

        $this->data['productcategories'] = $this->product_categories_model->get();

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Re Order Product Categories";

        $this->loadScript("https://code.jquery.com/ui/1.13.2/jquery-ui.js");

        $this->data["content"]=$this->load->view("/product_categories/reorder",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);   
    }

}