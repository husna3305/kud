<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("order", "asc");
        $query = $this->db->get('brand');
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
        $this->db->where_in('user_id', $user_id); 
        $this->db->where('active', '1'); 
        $query = $this->db->get('brand');
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
        $sql = "select * from brand where is_parent='1'";
        return $this->db->query($sql);
    }

    public function get_by_brandid($brand_id)
    {
        $sql = "select * from brand where brand_id=$brand_id";
        return $this->db->query($sql);
    }

    public function get_active()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from brand where user_id=$user_id and active=1 ";
        return $this->db->query($sql);
    }

    public function get_is_header()
    {
        $sql = "select * from brand where is_menu_header='1'";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('brand',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('brand', $data, 'brand_id');
        return TRUE;
    }

}
