<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends MY_Controller {

    public $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['controller']   = str_replace("-","",$this->uri->segment(1,"dashboard"));
        $this->data['method']       = $this->uri->segment(2,"index");
        $this->load->model("expenses_model");
        $this->mybreadcrumb->add('Expenses', base_url('expenses/listing'));

        $this->load->model("accesscontrol_model");
        $this->data['perms']['add'] = $this->accesscontrol_model->authorised("expenses","add");
        $this->data['perms']['edit'] = $this->accesscontrol_model->authorised("expenses","edit");
        $this->data['perms']['delete'] = $this->accesscontrol_model->authorised("expenses","delete");
    }

    public function index()
    {
        $this->listing();
    }

    public function listing()
    {
        //Access Control
        if(!isAuthorised(get_class(),"listing")) return false;

        $per_page = empty($this->input->get('per_page'))?10:$this->input->get('per_page');
        $this->data['expenses'] = $this->expenses_model->get($this->uri->segment(3,1),$per_page,$this->input->get("start_date"),$this->input->get("end_date"));
        $total_records = $this->expenses_model->total_records();

        $this->data['pagination'] = getPagination('expenses/listing',$total_records,$per_page,3);
       
        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Expenses Listing";

        $this->data["content"]=$this->load->view("/expenses/listing",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);            

    }

    public function edit()
    {
        //Access Control
        if(!isAuthorised(get_class(),"edit")) return false;

        $uuid = $this->uri->segment(3);

        //Breadcrumbs
        $this->mybreadcrumb->add('Edit', base_url('expenses/edit'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Edit Expenses";
        $this->data['title_class'] = "fa-edit";

        $this->data['data'] = $this->expenses_model->getSingle($uuid);
        $this->data["content"]=$this->load->view("/expenses/edit",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);            

    }

    public function update()
    {
        //Access Control
        if(!isAuthorised(get_class(),"edit")) return false;

        $this->expenses_model->save();

        flashSuccess("Record has been saved");
        redirect(base_url('expenses/listing'));
    }

    public function add()
    {
        //Access Control
        if(!isAuthorised(get_class(),"add")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Add', base_url('expenses/add'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Add Expenses";
        $this->data['title_class'] = "fa-plus-square";

        $this->data["content"]=$this->load->view("/expenses/add",$this->data,true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);            

    }

    public function save()
    {
        //Access Control
        if(!isAuthorised(get_class(),"add")) return false;

        $this->expenses_model->save();

        flashSuccess("Record has been saved");
        redirect(base_url('expenses/listing'));
    }


}
