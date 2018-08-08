<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("order", "asc");
        $query = $this->db->get('currency');
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_active()
    {
        $sql = "select * from currency where active=1";
        return $this->db->query($sql);
    }

    public function get_by_variationid($variation_id)
    {
        $sql = "select * from variation where variation_id=$variation_id";
        return $this->db->query($sql);
    }

    public function get_by_productid($product_id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from variation_product
              join variation on variation_product.variation_id = variation.variation_id
              where product_id=$product_id";
        return $this->db->query($sql);
    }

    public function get_by_group_variationproductid($product_id)
    {
        $sql = "select * from variation_product
                join variation on variation_product.variation_id = variation.variation_id
              where product_id=$product_id group by variation_product.variation_id";
        return $this->db->query($sql);
    }

    public function get_is_header()
    {
        $sql = "select * from variation where is_menu_header='1'";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('variation',$data);
        return TRUE;
    }

    public function create_variation_product($data)
    {
        $query=$this->db->insert_batch('variation_product',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('variation', $data, 'variation_id');
        return TRUE;
    }

}
