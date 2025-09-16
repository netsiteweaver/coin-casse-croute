<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Importer extends MY_Controller {

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

    public function items()
    {
        $filename = "./data/menu-items.txt";
        $output = "./data/menu.csv";
        $handle = fopen($filename, "r");
        $hr = fopen($output,"w");
        $category = "";
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                if(strpos($line,"rs")){
                    $split = explode(" rs ",$line);
                }elseif(strpos($line,"Rs")){
                    $split = explode(" Rs ",$line);
                }else{
                    $split = [];
                    $split[2] = $line;
                    $category = $line;
                }
                $outputLine = trim($category);
                if(isset($split[1])) {
                    $outputLine .= "," . trim($split[0]);
                    $outputLine .= "," . $split[1];
                    fwrite($hr,$outputLine);
                    echo $outputLine."<br>";
                }
                // fwrite($hr,"\r");
            }
        
            fclose($handle);
            fclose($hr);
        }
    }

    public function process()
    {
        $filename = "./data/menu.csv";
        $handle = fopen($filename, "r");
        $display_order=1;
        $stockref = 1;
        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->db->truncate("products");
        $this->db->query("SET FOREIGN_KEY_CHECKS=1");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            
            $category_id = $this->db->select("id")->from("product_categories")->where("name",$data[0])->get()->row("id");
            if(empty($category_id)){
                $var = array(
                    'uuid'          =>  gen_uuid(),
                    'name'          =>  ucwords(trim($data[0])),
                    'created_by'    =>  '1',
                    'created_date'  =>  date("Y-m-d H:i:s"),
                    'status'        =>  '1',
                    'photo'         =>  '',
                    'display_order' =>  '1'
                );
                $this->db->insert("product_categories",$var);
                $category_id = $this->db->insert_id();
                debug($data,false);
            }
            // else{

                $var = array(
                    'uuid'          =>  gen_uuid(),
                    'stockref'      =>  str_pad($stockref++,5,'0',STR_PAD_LEFT),
                    'name'          =>  $data[1],
                    'description'   =>  $data[1],
                    'cost_price'    =>  '0',
                    'selling_price' =>  $data[2],
                    'photo'         =>  '',
                    'created_by'    =>  '1',
                    'created_date'  =>  date("Y-m-d H:i:s"),
                    'status'        =>  '1',
                    'category_id'   =>  $category_id,
                    'display_order' =>  $display_order++,
                    'type'          =>  'product',
                    'vat'           =>  '15'
                );
                $this->db->insert("products",$var);

            // }

        }
    }

    public function processAddons()
    {
        $filename = "./data/addons.csv";
        $handle = fopen($filename, "r");
        $display_order=1;
        $stockref = 1;
        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        // $this->db->truncate("products");
        $this->db->truncate("addons_categories");
        $this->db->query("SET FOREIGN_KEY_CHECKS=1");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            
                $var = array(
                    'uuid'          =>  gen_uuid(),
                    'stockref'      =>  "ADD" . str_pad($stockref++,5,'0',STR_PAD_LEFT),
                    'name'          =>  $data[0],
                    'description'   =>  $data[0],
                    'cost_price'    =>  '0',
                    'selling_price' =>  $data[1],
                    'photo'         =>  '',
                    'created_by'    =>  '1',
                    'created_date'  =>  date("Y-m-d H:i:s"),
                    'status'        =>  '1',
                    'category_id'   =>  null,
                    'display_order' =>  $display_order++,
                    'type'          =>  'addon',
                    'vat'           =>  '15'
                );
                $this->db->insert("products",$var);

            // }

        }
    }

}
