<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wholesale_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function get_all()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from wholesale_product where user_id=$user_id";
        return $this->db->query($sql);
    }
    public function get_by_productid($product_id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from wholesale_product where product_id = $product_id and user_id=$user_id";
        return $this->db->query($sql);
    }

    public function get_by_public_productid($product_id)
    {
        $sql = "select * from wholesale_product where product_id = $product_id";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('wholesale_category',$data);
        return TRUE;
    }

    public function create_wholesaleproduct($data)
    {
        $query=$this->db->insert_batch('wholesale_product',$data);
        return TRUE;
    }

    function update_wholesaleproduct($data)
    {
        $this->db->update_batch('wholesale_product', $data, 'wholesale_id');
        return TRUE;
    }

    function delete_wholesaleproduct($data)
    {
      $this->db->delete('wholesale_product', array('wholesale_id' => $data));
    }
}
