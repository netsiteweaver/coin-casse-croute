<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require_once __DIR__ . '/../../vendor/autoload.php';

// use Dompdf\Dompdf;

class Orders extends MY_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['controller']   = str_replace("-", "", $this->uri->segment(1, "dashboard"));
        $this->data['method']       = $this->uri->segment(2, "index");

        $this->mybreadcrumb->add('Orders', base_url('orders/listing'));

        $this->load->model("accesscontrol_model");
        $this->data['perms']['add'] = $this->accesscontrol_model->authorised("orders", "add");
        $this->data['perms']['edit'] = $this->accesscontrol_model->authorised("orders", "edit");
        $this->data['perms']['view'] = $this->accesscontrol_model->authorised("orders", "view");
        $this->data['perms']['delete'] = $this->accesscontrol_model->authorised("orders", "delete");

        $this->load->model("orders_model");
    }

    public function index()
    {
        redirect(base_url('orders/listing'));
    }

    public function add()
    {
        //Access Control
        if (!isAuthorised(get_class(), "add")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Add', base_url('orders/add'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->data['page_title'] = "New Order";

        $this->load->model("departments_model");
        $this->data['departments'] = $this->departments_model->getAllDepartments();

        $this->load->model("nationalities_model");
        $this->data['nationalities'] = $this->nationalities_model->get();

        $this->load->model("product_categories_model");
        $this->data['product_categories'] = $this->product_categories_model->get();

        $this->load->model("paymentmodes_model");
        $this->data['payment_modes'] = $this->paymentmodes_model->get();

        $this->load->model("customers_model");
        $this->data['customers'] = $this->customers_model->lookup();

        $this->data["content"][] = $this->load->view("/orders/add", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/pos",$this->data);
    }

    public function save()
    {
        $result = $this->orders_model->save();
        if($result['affected_rows']>0){
            echo json_encode(array(
                "result"        =>  true,
                "id"            =>  $result['id'],
                "uuid"          =>  $result['uuid'],
                "order_number"  =>  $result['document_number'],
                "affected_rows" =>  $result['affected_rows']
            ));
        }else{
            echo json_encode(array("result"=>false));
        }
        exit;
    }

    public function receipt()
    {
        //Access Control 
        if (!isAuthorised(get_class(), "add")) return false;

        $uuid = $this->uri->segment(3);
        $this->load->model("orders_model");
        $this->data['order'] = $this->orders_model->getByUuid($uuid);
        if(empty($this->data['order'])){
            flashDanger("Order not found");
            redirect(base_url("orders/listing"));
        }
        $this->data['page_title'] = null;

        $this->mybreadcrumb->add('View', base_url('orders/view/'.$uuid));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->data['page_title'] = "Receipt";

        $this->data['footer_message'] = $this->system_model->getParam('footer_message');
        $this->data['total_items'] = $this->system_model->getParam('total_items');
        $this->data['company'] = $this->system_model->getCompanyInfo();

        $this->loadStyleSheet("assets/css/pos-receipt.css?t=".date("ymdHis"));

        $this->addContent($this->load->view("/orders/pos-receipt",$this->data,true));
        $this->load->view("/layouts/AdminLTE-3.2.0/empty",$this->data);
        
    }

    public function listing()
    {
        //Access Control        
        if (!isAuthorised(get_class(), "listing")) return false;

        $this->load->model("system_model");
        $this->data['rows_per_page'] = empty($this->input->get("display"))?10:$this->input->get("display");
        $start_date = $this->input->get("start_date");
        $end_date = $this->input->get("end_date");
        $page = $this->uri->segment(3, '1');
        $search_text = $this->input->get('search_text');
        $this->data['orders'] = $this->orders_model->get($start_date, $end_date, $page, false,$this->data['rows_per_page'],[],$search_text);
        $this->data['total_records'] = $this->orders_model->total_records($start_date, $end_date, $search_text);
        $this->data['pagination'] = getPagination("orders/listing",$this->data['total_records'],$this->data['rows_per_page']);

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Orders Listing";

        $this->data["content"] = $this->load->view("/orders/listing", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function delete()
    {
        if (!isAuthorised(get_class(), "edit")) return false;

        $uuid = $this->input->post("uuid");
        $this->orders_model->delete($uuid);

        echo json_encode(array("result"=>true));
    }

}