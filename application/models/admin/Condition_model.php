<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condition_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("order", "asc");
        $query = $this->db->get('condition');
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

     public function get_all_active_SuperAdmin($user_id)
    {
        $this->db->order_by("order", "asc");
        $this->db->where('active', '1'); 
        $this->db->where_in('user_id', $user_id); 
        $query = $this->db->get('condition');
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_is_parent()
    {
        $sql = "select * from condition where is_parent='1'";
        return $this->db->query($sql);
    }

    public function get_active()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from `condition` where active='1' and user_id = $user_id ";
        return $this->db->query($sql);
    }

    public function get_by_public_productid($product_id)
    {
        $sql = "select `condition`.* from product
                left join `condition` on product.condition_id=condition.condition_id
                where product_id = $product_id";
        return $this->db->query($sql);
    }

    public function get_by_conditionid($condition_id)
    {
        $sql = "SELECT * FROM `condition` WHERE condition_id=$condition_id";
        return $this->db->query($sql);
    }

    public function get_is_header()
    {
        $sql = "select * from condition where is_menu_header='1'";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('condition',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('condition', $data, 'condition_id');
        return TRUE;
    }

}
