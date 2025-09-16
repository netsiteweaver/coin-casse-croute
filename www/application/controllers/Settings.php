<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['controller'] = str_replace("-", "", $this->uri->segment(1, "dashboard"));
        $this->data['method'] = $this->uri->segment(2, "index");
        $this->load->model("system_model");

        $this->load->model("accesscontrol_model");
        $this->data['perms']['notifications'] = $this->accesscontrol_model->authorised("settings","notifications");
    }

    public function params()
    {
        //Access Control
        if(!isAuthorised(get_class(),"params")) return false;
        //Get all params. If you need to get only one specific parameter, use getParam() with the 
        //the name of the parameter as parameter, like getParam('rows_per_page')
        $params = $this->system_model->getAllParams();
        foreach ($params as $param) {
            $this->data[$param->title] = $param->value;
        }

        $this->data['send_enquiries_to'] = $this->system_model->getParam('send_enquiries_to',true);
        $this->data['smtp_settings'] = $this->system_model->getParam('smtp_settings',true);
        $this->data['footer_message'] = $this->system_model->getParam('footer_message');
        $this->load->model('users_model');
        $this->data['admins'] = $this->users_model->getAdmins();
        $this->data['users'] = $this->users_model->getAll();
        
        $this->mybreadcrumb->add('System Params', base_url('settings/params'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->data["content"]=$this->load->view("/settings/params2",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);        
    }

    public function test_email()
    {
        //fetch current user's email
        $user = $this->db->select("email")->from("users")->where("id",$_SESSION['user_id'])->get()->row();
        $this->load->model("email_model");
        $result = $this->email_model->send($user->email,'✅ Test Email','Hello<br>This is a test email.');
        if($result){
            echo json_encode(array(
                'result'=>true,
                'email'=>$user->email
            ));
        }else{
            echo json_encode(array("result"=>false));
        }
        exit;
    }

    public function updateparams()
    {
        //Access Control
        if(!isAuthorised("settings","params")) return false;

        $this->load->model("system_model");
        $this->system_model->updateParams();

        flashSuccess("Params have been updated");
        redirect(base_url('settings/params'));
    }

    public function company()
    {
        //Access Control
        if(!isAuthorised(get_class(),"company")) return false;

        $this->load->model("system_model");
        $this->data['company'] = $this->system_model->getCompanyInfo();

        $this->mybreadcrumb->add('Company Settings', base_url('settings/company'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->data["content"]=$this->load->view("/settings/company",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);        
    }

    public function updatecompany()
    {
        //Access Control
        if(!isAuthorised(get_class(),"company")) return false;

        $this->load->model("system_model");
        $this->system_model->updateCompany();

        flashSuccess("Company details have been updated");
        redirect(base_url('settings/company'));
    }

    public function menu_order()
    {
        //Access Control
        if(!isAuthorised(get_class(),"menu_order")) return false;

        $this->data['page_title'] = "Menu Order";

        $this->load->model("menu_model");
        $this->data['resources'] = $this->menu_model->getforlisting();

        $this->data["content"]=$this->load->view("/settings/menu",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);        

    }

    public function notifications()
    {
        //Access Control
        if(!isAuthorised(get_class(),"notifications")) return false;
        
        $notifs = $this->system_model->getParam('notifications',true);
        $stages = [];
        foreach($notifs as $n){
            $stages[$n->stage][$n->user] = 1;//$n->user;
        }
        $this->data['notifications'] = $stages;
        
        $this->mybreadcrumb->add('Notifications', base_url('settings/notifications'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->load->model("stages_model");
        $this->load->model("users_model");
        $this->data['stages'] = $this->stages_model->get();
        $this->data['users'] = $this->users_model->get();

        $this->data["content"]=$this->load->view("/settings/notifications",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);        
    }

    public function updatenotifications()
    {
        //Access Control
        if(!isAuthorised("settings","params")) return false;

        $this->load->model("system_model");
        $this->system_model->updatenotifications();

        echo json_encode(array("result",true));
    }
}
