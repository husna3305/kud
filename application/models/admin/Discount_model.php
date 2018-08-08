<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("order", "asc");
        $query = $this->db->get('category');

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_productid($product_id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from product_discount
                join product on product_discount.product_id = product.product_id
                left join product_attachment on product_attachment.product_id = product.product_id
                left join currency on product_discount.currency_id = currency.currency_id
                where product_discount.product_id = $product_id and product_discount.user_id=$user_id
                and product_attachment.main_file=1
              ";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('product_discount',$data);
        return TRUE;
    }

    public function create_categoryproduct($data)
    {
        $query=$this->db->insert_batch('category_product',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('category', $data, 'category_id');
        return TRUE;
    }

}
