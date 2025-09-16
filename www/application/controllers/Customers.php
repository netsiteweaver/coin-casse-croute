<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends MY_Controller
{

    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['controller']   = str_replace("-", "", $this->uri->segment(1, "dashboard"));
        $this->data['method']       = $this->uri->segment(2, "index");
        $this->mybreadcrumb->add('Customers', base_url('customers/listing'));
        
        $this->load->model("accesscontrol_model");
        $this->data['perms']['add'] = $this->accesscontrol_model->authorised("customers", "add");
        $this->data['perms']['edit'] = $this->accesscontrol_model->authorised("customers", "edit");
        $this->data['perms']['view'] = $this->accesscontrol_model->authorised("customers", "view");
        $this->data['perms']['delete'] = $this->accesscontrol_model->authorised("customers", "delete");

        $this->load->model("customers_model");
    }

    public function index()
    {
        redirect(base_url('customers/listing'));
    }

    public function add()
    {
        //Access Control
        if (!isAuthorised(get_class(), "add")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Add', base_url('customers/add'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Add Customer";

        $this->load->model("nationalities_model");
        $this->data['nationalities'] = $this->nationalities_model->get();

        $this->data["content"] = $this->load->view("/customers/add", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function save()
    {
        //Access Control
        if (!isAuthorised(get_class(), "add")) return false;

        $referer = $this->input->post("referer");
        $result = $this->customers_model->save();

        flashSuccess("Customers saved successfully..");
        redirect(base_url(empty($referer)?"customers/listing":$referer));
    }

    public function edit()
    {
        //Access Control 
        if (!isAuthorised(get_class(), "edit")) return false;

        $uuid = $this->uri->segment(3);
        $this->data['customer'] = $this->customers_model->get($uuid);

        if(empty($this->data['customer'])){
            flashDanger("Customer not found");
            redirect(base_url("customers/listing"));
        }

        $this->load->model("nationalities_model");
        $this->data['nationalities'] = $this->nationalities_model->get();

        //Breadcrumbs
        $this->mybreadcrumb->add('Edit', base_url('customers/edit'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->data["content"] = $this->load->view("/customers/edit", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function view()
    {
        //Access Control 
        if (!isAuthorised(get_class(), "view")) return false;

        $uuid = $this->uri->segment(3);
        $this->data['customer'] = $this->customers_model->getCustomerByUuid($uuid);
        $this->data['history'] = $this->customers_model->salesHistory($uuid);
        //Breadcrumbs
        $this->mybreadcrumb->add('View', base_url('customers/view'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->load->model("regions_model");
        $this->data['regions'] = $this->regions_model->getAll();

        $this->data["content"] = $this->load->view("/customers/view", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function update()
    {
        //Access Control        
        if (!isAuthorised(get_class(), "edit")) return false;

        $postedData = $this->input->post();


        $this->load->model('customers_model');
        $result = $this->customers_model->update($postedData);

        if ($result['result']) {
            flashSuccess("Customers has been successfully updated");
            redirect(base_url('customers/listing'));
        } else {

            flashSuccess("Error in updating Customer");
            redirect(base_url('customers/edit'));
        }
    }

    public function listing()
    {
        //Access Control        
        if (!isAuthorised(get_class(), "listing")) return false;

        $this->load->model("system_model");
        $this->data['rows_per_page'] = empty($this->input->get("display"))?$this->system_model->getParam("rows_per_page"):$this->input->get("display");
        $page = $this->uri->segment(3, '1');

        $this->data['customers'] = $this->customers_model->get(null,$page,$this->data['rows_per_page'],$this->input->get('search_text'));
        $total_records = $this->customers_model->total_records($this->input->get('search_text'));

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Customers";

        $this->data['pagination'] = getPagination("customers/listing",$total_records,$this->data['rows_per_page']);

        $this->data["content"] = $this->load->view("/customers/listing", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function getCustomerDetailsForSalesById()
    {
        $id = $this->input->post("id");
        $customer = $this->db->select('*')->from('customers')->where('customer_id',$id)->get()->row();
        $routes = $this->db->select("rr.route_id,rt.description")
                        ->from("routes_regions as rr")
                        ->join("routes as rt","rt.route_id=rr.route_id")
                        ->where("rr.region_id",$customer->region)
                        ->get()->result();

        $sql = $this->SqlQry_model->getSalesPerCustomer($id);
        $sales = $this->db->query($sql)->result();

        echo json_encode(array("result" => true, "customer"=>$customer,"routes"=>$routes,"sales"=>$sales));
    }

    public function quick_save()
    {
        $result = $this->customers_model->quick_save();
        echo json_encode($result);
        exit;
    }
}
