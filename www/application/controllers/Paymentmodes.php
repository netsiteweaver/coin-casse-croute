<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Paymentmodes extends MY_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();

        $this->mybreadcrumb->add('Delivery', base_url('delivery/listing'));

        $this->load->model("accesscontrol_model");
        $this->data['perms']['add'] = 1;//$this->accesscontrol_model->authorised("payment_modes", "add");
        $this->data['perms']['edit'] = 1;//$this->accesscontrol_model->authorised("payment_modes", "edit");
        $this->data['perms']['delete'] = 1;//$this->accesscontrol_model->authorised("payment_modes", "delete");
        $this->data['perms']['view'] = 1;//$this->accesscontrol_model->authorised("payment_modes", "view");

        $this->load->model("paymentmodes_model");
    }

    public function listing()
    {
        //Access Control
//        if (!isAuthorised(get_class(), "listing")) return false;

        $this->data['paymentmodes'] = $this->paymentmodes_model->get();

        //Breadcrumbs
        $this->mybreadcrumb->add('Payment Modes', base_url('paymentmodes/listing'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Payment Modes";

        $this->data["content"] = $this->load->view("/paymentmodes/listing", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function add()
    {
        //Access Control
//        if (!isAuthorised(get_class(), "listing")) return false;

        //Breadcrumbs
        $this->mybreadcrumb->add('Payment Modes', base_url('paymentmodes/listing'));
        $this->mybreadcrumb->add('Add Payment Mode', base_url('paymentmodes/add'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Add Payment Mode";

        $this->data["content"] = $this->load->view("/paymentmodes/add", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function edit()
    {
        //Access Control
//        if (!isAuthorised(get_class(), "listing")) return false;

        $this->data['data'] = $this->paymentmodes_model->get($this->uri->segment(3));

        //Breadcrumbs
        $this->mybreadcrumb->add('Payment Modes', base_url('paymentmodes/listing'));
        $this->mybreadcrumb->add('Edit Payment Mode', base_url('paymentmodes/edit'));
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->data['page_title'] = "Edit Payment Mode";

        $this->data["content"] = $this->load->view("/paymentmodes/edit", $this->data, true);
        $this->load->view("/layouts/AdminLTE-3.2.0/default",$this->data);
    }

    public function save()
    {
        $this->paymentmodes_model->save();
        redirect(base_url("paymentmodes/listing"));
    }
}