<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['controller']   = str_replace("-","",$this->uri->segment(1,"dashboard"));
        $this->data['method']       = $this->uri->segment(2,"index");
        $this->load->model("Channels_model");
        $this->mybreadcrumb->add('Channels', base_url('channels/listing'));
        $this->load->model("accesscontrol_model");
        $this->data['perms']['add'] = $this->accesscontrol_model->authorised("channels","add");
        $this->data['perms']['edit'] = $this->accesscontrol_model->authorised("channels","edit");
        $this->data['perms']['delete'] = $this->accesscontrol_model->authorised("channels","delete");

        
    }

    public function index()
    {
        $fh = fopen("cron.txt",'a+');
        if(!$fh){
            echo "Unable to create file";
        }else{
            fwrite($fh,date("YmdHis").": Hello World!");
            fwrite($fh,"\r\n");
            fclose($fh);
        }
    }

    public function sendEmails()
    {
        $emails = $this->db->select("*")->from("email_queue")->where("stage !=","sent")->limit(10)->get()->result();
        if(!empty($emails)){
            $this->load->model("email_model");
            foreach($emails as $email){
                $this->stage($email->id,"sending");
                $to = $email->recipients;
                $subject = $email->subject;
                $message = $email->content;
                $result = $this->email_model->sendFromQueue($to,$subject,$message);
                if($result){
                    $this->stage($email->id,"sent");
                }else{
                    $this->stage($email->id,"failed");
                }
            }
        }
    }

    private function stage($id,$stage)
    {
        $this->db->query("SET @@session.time_zone = '+04:00'");
        $this->db->set("stage",$stage);
        $this->db->set("date_sent","NOW()",false);
        $this->db->where("id",$id)->update("email_queue");
    }

}