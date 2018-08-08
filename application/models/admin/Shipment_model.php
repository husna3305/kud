<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment_model extends CI_Model {

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

     public function get_by_userid()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from `shop` 
                join users on shop.user_id=users.id
                where shop.user_id = $user_id ";
        return $this->db->query($sql);
    }

    public function get_active()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select * from `condition` where active='1' and user_id = $user_id ";
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
        $query=$this->db->insert_batch('shop',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('shop', $data, 'shop_id');
        return TRUE;
    }

}
