<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $sql = "select *, condition.name as cond_name from product
                left join `condition` on condition.condition_id = product.condition_id
        ";
        return $this->db->query($sql);
    }

     public function get_all_search()
    {
        $sql = "select product.name, product.product_id, product.sku, product.price,
                users.username, brand.name as brand_name from product
                left join brand on product.brand_id = brand.brand_id
                left join users on product.user_id = users.id
        ";
        return $this->db->query($sql);
    }

    public function get_all_by_attachment()
   {
       $sql = "  select * from product
                 join product_attachment on product_attachment.product_id = product.product_id
       ";
       return $this->db->query($sql);
   }
   public function get_all_by_category()
    {
        $sql = "  select product.product_id, category.category_id, category.name from product
                  left join category_product on category_product.product_id = product.product_id
                  left join category on category_product.category_id = category.category_id
        ";
        return $this->db->query($sql);
    }

    public function get_by_productid($product_id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from product
                join currency on product.currency_id = currency.currency_id
                where product_id = $product_id and user_id = $user_id";
        return $this->db->query($sql);
    }

    public function get_by_public_useridseller_productid($user_id, $product_id)
    {
        
        $sql = "select product.*, brand.name as brand_name, currency.*, condition.name as condition_name 
                from product
                left join `condition` on product.condition_id = condition.condition_id
                left join brand on product.brand_id = brand.brand_id
                left join currency on product.currency_id = currency.currency_id
                where `product_id` = $product_id and product.user_id = $user_id";
        return $this->db->query($sql);
    }

    public function get_by_public_productid($product_id)
    {
        
        $sql = "select product.*, brand.name as brand_name, currency.*, condition.name as condition_name 
                from product
                left join `condition` on product.condition_id = condition.condition_id
                left join brand on product.brand_id = brand.brand_id
                left join currency on product.currency_id = currency.currency_id
                where `product_id` = $product_id";
        return $this->db->query($sql);
    }

    public function get_by_productid_mainattachment($product_id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from product
                join currency on product.currency_id = currency.currency_id
                left join product_attachment on product_attachment.product_id = product.product_id
                where product.product_id = $product_id and product.user_id = $user_id and product_attachment.main_file=1";
        return $this->db->query($sql);
    }

    public function get_by_product_attachment_id($product_attachment_id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from product_attachment where product_attachment_id = $product_attachment_id and user_id = $user_id";
        return $this->db->query($sql);
    }

    public function get_by_productattachment_productid($product_id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from product_attachment where product_id = $product_id and user_id = $user_id order by main_file desc";
        return $this->db->query($sql);
    }

    public function get_by_public_productattachment_productid($product_id)
    {
        $sql = "select * from product_attachment where product_id = $product_id order by main_file desc";
        return $this->db->query($sql);
    }


    public function get_by_userid_undeleted()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select product.product_id,product.deleted, product.price, product.active, product.name as pd_name, condition.name as cond_name, product.sku,
            brand.name as brand_name 

        from product
            left join brand on product.brand_id=brand.brand_id
                left join `condition` on condition.condition_id = product.condition_id
                where product.user_id = $user_id and product.deleted=0";
        return $this->db->query($sql);
    }

    public function get_by_maxid_userid()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select max(product_id) as product_id from product where user_id=$user_id";
        return $this->db->query($sql);
    }

    public function get_all_combineproduct()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from combine_product
                join product on combine_product.combine_product=product.product_id
                join product_attachment on combine_product.combine_product=product_attachment.product_id
                where combine_product.user_id = $user_id and product_attachment.main_file=1";
        return $this->db->query($sql);
    }

    public function get_by_combineproductid($id)
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select main_product_id, combine_product, price_cut, price_combine,filename,name,price,combine_id
                from combine_product
                join product on combine_product.combine_product=product.product_id
                join product_attachment on combine_product.combine_product = product_attachment.product_id                
                where combine_product.main_product_id=$id and combine_product.user_id = $user_id and product_attachment.main_file=1";
        return $this->db->query($sql);
    }

    public function get_combineproduct_by_mainproduct_combineproduct($main_product_id,$combine_product )
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from combine_product           
                where main_product_id=$main_product_id and user_id = $user_id and combine_product=$combine_product";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('product',$data);
        return TRUE;
    }

    public function create_combineproduct($data)
    {
        $query=$this->db->insert_batch('combine_product',$data);
        return TRUE;
    }
    function update_combineproduct($data)
    {
        $this->db->update_batch('combine_product', $data, 'combine_id');
        return TRUE;
    }
    function delete_combineproduct($combine_id)
    {
        $this->db->where('combine_id', $combine_id);
        $this->db->delete('combine_product'); 
    }


    public function create_product_attachment($data)
    {
        $query=$this->db->insert_batch('product_attachment',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('product', $data, 'product_id');
        return TRUE;
    }

}
