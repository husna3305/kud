<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Top_product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("order", "asc");
        $query = $this->db->get('top_product');
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
        $sql = "select * from top_product 
                left join product on top_product.product_id = product.product_id
                left join product_attachment on product.product_id = product_attachment.product_id
                left join currency on product.currency_id = currency.currency_id
                left join users on product.user_id = users.id
                where top_product.active=1 and product_attachment.main_file=1";
        return $this->db->query($sql);
    }

     public function get_by_userid($user_id)
    {
        $sql = "select * from top_product 
                join product on top_product.product_id = product.product_id
                where top_product.active=1 and top_product.user_id = $user_id";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('top_product',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('top_product', $data, 'top_product_id');
        return TRUE;
    }

}
