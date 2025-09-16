<?php

class Render extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pages_model');
    }

    public function index()
	{
		$lang = 'en';
		$page_name = $this->uri->segment(3);
		$skip_first_block = false;
		if(in_array($page_name,array('industries','solutions'))){
			$page_name = $this->uri->segment(3);
			$skip_first_block=true;
		}
		try {
			$this->data['page'] = $this->pages_model->get($page_name,$skip_first_block);
		} catch (Exception $e){
			show_error($e->getMessage(),'404','Error');
		}
		$this->data['page_title'] = ucwords(strtolower($this->data['page']->name));
		foreach($this->data['page']->blocks as $i => $block){
			$this->data['block'] = json_decode($this->data['page']->blocks[$i]->content);
			$this->data['template'] = $block->template;
			if(!empty($block->query)){
				$this->data['result'] = $this->db->query($block->query)->result();
			}
			$this->load->view('templates/'.$this->data['template'],$this->data);
		}
		
	}
}