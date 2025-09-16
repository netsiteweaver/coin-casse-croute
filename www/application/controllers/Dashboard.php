<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $data;

    public function __construct()
    {
        parent::__construct();

        $this->load->model("accesscontrol_model");
        $this->data['perms']['dashboard'] = $this->accesscontrol_model->authorised("settings","dashboard");

        // $this->data['stage_classes'] = ['bg-blue','bg-maroon','bg-purple','bg-lime','bg-red',"bg-orange","bg-yellow","bg-green","bg-teal","bg-olive","bg-navy",'bg-blue','bg-maroon','bg-purple','bg-lime','bg-red',"bg-orange","bg-yellow","bg-green","bg-teal","bg-olive","bg-navy"];
    }

    public function index()
    {
        //Access Control
        if(!isAuthorised(get_class(),"index")) return false;

        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "The Dashboard";

        $this->loadScript("assets/js/pages/chart.js");

        $this->load->model("orders_model");
        $this->data['orders'] = $this->orders_model->recent(5);

        $this->load->model("products_model");
        $this->data['products'] = $this->products_model->recent(5);
        $this->data['addons'] = $this->products_model->recent(5,"addon");

        $this->load->model("customers_model");
        $this->data['customers'] = $this->customers_model->recent(5);

        // if($_SESSION['user_level'] == 'Normal'){
        //     $this->addContent($this->load->view("/dashboard/normal_user",$this->data,true));
        // }else{
        //     // $this->load->model("Stages_model");
        //     // $this->data['stages'] = $this->Stages_model->get();
        //     // // shuffle($this->data['stage_classes']);
        //     // $this->addContent($this->load->view("/dashboard/index",$this->data,true));

        //     $this->load->model("users_model");
        //     $this->data['latest_logins'] = $this->users_model->get_login_history(25);
        //     $this->load->model("orders_model");
        //     $this->data['latest_orders'] = $this->orders_model->recent(20);
            $this->addContent($this->load->view("/dashboard/test",$this->data,true));
        // }
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);

    }

}