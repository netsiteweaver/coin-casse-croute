<?php
/**
 * Description of MY_Controller
 *
 * @author <Reeaz Ramoly at Netsiteweaver>
 */
class MY_Controller extends CI_Controller{
    
    public $data;
    
    public function __construct() {
        
        parent::__construct();
        
        $this->data['controller']   = str_replace("-","",$this->uri->segment(1,"dashboard"));
        $this->data['method']       = $this->uri->segment(2,"index");

        $userid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

        $this->loadModels();
        
        $this->data['company'] = $this->system_model->getCompanyInfo();
        // $this->data['theme'] = $this->system_model->getParam("theme");
        $this->data['logo'] = $this->system_model->getParam("logo");
        $this->data['theme_color'] = $this->system_model->getParam('theme_color');
        // $this->data['sidebar_collapse'] = $this->system_model->getParam("sidebar_collapse");
        $this->data['current_version'] = $this->system_model->getParam("current_version");
        $this->data['controller'] = str_replace("-", "", $this->uri->segment(1, "dashboard"));
        $this->data['method'] = $this->uri->segment(2, "index");
        $this->data['authenticated_user'] = isset($_SESSION['authenticated_user'])?$_SESSION['authenticated_user']:null;
        $this->data['menu_items'] = $this->menu_model->get();
        $this->data['page_title'] = ucfirst($this->data['method']) . ' ' . ucfirst($this->data['controller']);
        $this->data['flashSuccess']     = getFlashMessage("success");
        $this->data['flashWarning']     = getFlashMessage("warning");
        $this->data['flashDanger']      = getFlashMessage("danger");
        $this->data['flashInfo']        = getFlashMessage("info"); 
        $this->data['upload_folder'] = $this->config->item("upload_folder");
        $this->mybreadcrumb->add('Dashboard', base_url('dashboard/index'));
        $metadata = array();
        $metadata['GET'] = isset($_GET)?$_GET:'';
        $metadata['POST'] = isset($_POST)?$_POST:'';
        $metadata['FILES'] = isset($_FILES)?$_FILES:'';
        if(isset($_POST)) $notes = json_encode($metadata);
        $this->logger_model->save($notes);
        $this->data['perms']['myprofile'] = $this->accesscontrol_model->authorised("users","myprofile");

        $this->db->query("SET @@session.time_zone = \"+04:00\"");
        header('Access-Control-Allow-Origin: *');
    }

    private function loadModels(){
        $this->load->model("menu_model");
        $this->load->model("logger_model");
        $this->load->model("system_model");
        $this->load->model("accesscontrol_model");
    }

    public function loadJs($script){$this->loadScript($script);}
    public function loadScript($script)
    {
        $this->data['scripts'][] = $script;
    }

    public function loadCss($stylesheet){$this->loadStyleSheet($stylesheet);}
    public function loadStyleSheet($stylesheet)
    {
        $this->data['stylesheets'][] = $stylesheet;
    }

    public function addContent($content){
        $this->data['content'][] = $content;
    }
}
