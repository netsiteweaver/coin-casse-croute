<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Inventory_model extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
     }

     public function get()
     {
          $departments = $this->db->select("*")->from("departments")->where("status","1")->get()->result();

          $items = $this->db->select("p.product_id,p.uuid,p.stockref,p.product_name,p.unit_price,p.selling_price,p.delivery_fee,pb.brand_name,pc.category_name,pcl.color,pcl.color_name")
          ->from("products p")
          ->join("product_brands pb","pb.product_brand_id=p.fk_brand_id","left")
          ->join("product_category pc","pc.product_category_id=p.fk_category_id","left")
          ->join("colors pcl","pcl.color_id=p.fk_color_id","left")
          ->where("p.status","1")
          ->order_by("stockref")
          ->get()
          ->result();

          foreach($items as $i => $item){
               foreach($departments as $d){
                    $quantity = $this->db->select("quantity")->from("inventory")->where(array(
                         "product_id"=>$item->product_id,
                         "department_id"     =>   $d->id
                    ))->get()->row("quantity");

                    $items[$i]->inventory[$d->id] = $quantity;

               }
          }

          return $items;
     }

     public function ProductQtyUpdate($productId, $quantity, $type, $department_id)
     {

          //if type is purchase
          //add quantity to department to product with store 1 only
          // else if type is sales
          //take quantity minus with inital quantity from inventory to product with user dpt id

          $finalquantity = 0;

          $this->db->select('quantity');
          $this->db->where("product_id", $productId);

          if ($type == "purchases") {
               $department_id = 1;
               $this->db->where("department_id", $department_id);
               $query =  $this->db->get("inventory s");
               $result = $query->row();

               $finalquantity = $result->quantity + $quantity;
          }

          if ($type == "CreditNote") {
               $this->db->where("department_id", $department_id);
               $query =  $this->db->get("inventory s");
               $result = $query->row();

               $finalquantity = $result->quantity + $quantity;
          }

          if ($type == "sales") {
               $this->db->where("department_id", $department_id);
               $query =  $this->db->get("inventory s");
               $result = $query->row();

               $finalquantity =  $result->quantity - $quantity;
          }

          if($type == "delivery")
          {
               $this->db->where("department_id", $department_id);
               $query =  $this->db->get("inventory s");
               $result = $query->row();

               $finalquantity =  $result->quantity + $quantity;
          }


          $this->db->set('quantity', $finalquantity);
          $this->db->where('product_id', $productId);
          $this->db->where('department_id', $department_id);
          $this->db->update('inventory');

          return array('result' => true);
     }

     public function update($item_id,$department_id,$quantity)
     {
          $this->db->set("quantity","quantity+".$quantity,FALSE);
          $this->db->where(array(
               'product_id'   =>   $item_id,
               'department_id'=>   $department_id
          ));
          $this->db->update("inventory");
     }
}
