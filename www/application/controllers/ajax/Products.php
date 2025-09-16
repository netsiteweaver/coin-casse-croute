<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function getByCategoryId()
    {
        $categoryId = $this->input->get("id");
        $result = $this->db->select("p.*,pc.name as categoryName")
                            ->from("products p")
                            ->join("product_categories pc","pc.id=p.category_id","left")
                            ->where(array("p.status"=>"1","category_id"=>$categoryId))
                            ->order_by("p.display_order","asc")
                            ->get()
                            ->result();
        if(!empty($result)) {
            $addonsObj = $this->db->select('ac.*,ad.*')
                                ->from("addons_categories ac")
                                ->join("product_categories pc","pc.id=ac.product_category_id")
                                ->join("products ad","ad.id=ac.addon_id","left")
                                ->where("ac.product_category_id",$categoryId)
                                ->order_by("ad.display_order","asc")
                                ->get()
                                ->result();
                                // debug($result);
                                // debug($addonsObj);
        }
        // debug($result);
        echo json_encode(array("result"=>true,"products"=>$result,"rows"=>count($result),"addons"=>$addonsObj));
        exit;
    }

    public function getCategories()
    {
        $result = $this->db->select("*")
                            ->from("product_categories pc")
                            ->where("pc.status","1")
                            ->order_by("pc.display_order, pc.name","asc")
                            ->get()
                            ->result();
        echo json_encode(array("result"=>true,"categories"=>$result,"rows"=>count($result)));
        exit;
    }
}