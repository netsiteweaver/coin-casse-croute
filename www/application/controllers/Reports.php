<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends MY_Controller
{

    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['controller']   = str_replace("-", "", $this->uri->segment(1, "dashboard"));
        $this->data['method']       = $this->uri->segment(2, "index");
        $this->mybreadcrumb->add('Reports', base_url('reports/index'));
        $this->load->model("accesscontrol_model");
        $this->load->model("orders_model");
        $this->load->model("system_model");
    }

    public function index()
    {
        //Access Control
        if (!isAuthorised("reports","index")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Reports', base_url('reports/index'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Reports Selector";

        $this->data["content"] = $this->load->view("/reports/index", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function orders()
    {
        //Access Control
        if (!isAuthorised("reports","orders")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Orders', base_url('reports/orders'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Orders Report";

        $this->data['agents'] = $this->db->select("id,name")->from("users")->where("status","1")->get()->result();
        $this->data['payment_modes'] = $this->db->select("id,name")->from("payment_modes")->where("status","1")->get()->result();

        $this->data["content"] = $this->load->view("/reports/orders", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function processOrders()
    {
        $type = $this->input->post("type");
        $singleDate = $this->input->post("singleDate");
        $mMonth = $this->input->post("mMonth");
        $mYear = $this->input->post("mYear");
        $year = $this->input->post("year");
        $dateRange = $this->input->post("dateRange");
        $dt = explode(" - ",$dateRange);
        $startDate = $dt[0];
        $endDate = $dt[1];
        $options = $this->input->post("options");

        // debug($options);

        $this->db->select("
                o.*
                , u.name as agent
                , pm.name paymentMode
                ")
                ->from("orders o")
                ->join("users u","u.id=o.created_by","left")
                ->join("payment_modes pm","pm.id=o.payment_mode_id","left");
        $this->db->where("o.status","1");

        switch($type){
            case "day":
                $this->db->where(["DATE(o.order_date)"=>$singleDate]);
                break;
            case "month":
                $this->db->where(["MONTH(o.order_date)"=>$mMonth,"YEAR(o.order_date)"=>$mYear]);
                break;
            case "year":
                $this->db->where(["YEAR(o.order_date)"=>$year]);
                break;
            case "custom":
                $this->db->where(["DATE(o.order_date)>="=>$dt[0],"DATE(o.order_date)<="=>$dt[1]]);
                break;
        }
        if(!empty($options['payment_mode_only'])) $this->db->where("o.payment_mode_id",$options['payment_mode_only']);
        if(!empty($options['agent_only'])) $this->db->where("o.created_by",$options['agent_only']);
        $this->db->order_by($options['sort_by'],$options['sort_dir']);
        $orders = $this->db->get()->result(); 
        echo json_encode(array(
            "result"        =>  true,
            "rows"          =>  count($orders),
            "orders"        =>  $orders,
            "query"         =>  $this->db->last_query()
        ));
        exit;     
    }

    public function products()
    {
        //Access Control
        if (!isAuthorised("reports","products")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Products', base_url('reports/products'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Products Report";

        $this->data["content"] = $this->load->view("/reports/products", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }
}
