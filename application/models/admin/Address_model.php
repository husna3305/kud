<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("order", "asc");
        $query = $this->db->get('address');
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_public_userid($user_id)
    {
        $sql = "select `users_address`.* from users_address
                where user_id = $user_id";
        return $this->db->query($sql);
    }

    public function get_by_public_userid_forshipment($user_id)
    {
        $sql = "select `users_address`.* from users_address
                where user_id = $user_id and for_shipment=1";
        return $this->db->query($sql);
    }

    public function get_by_address_id($address_id)
    {
        $sql = "select `users_address`.* from users_address
                where address_id = $address_id";
        return $this->db->query($sql);
    }

    public function get_is_header()
    {
        $sql = "select * from address where is_menu_header='1'";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('address',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('address', $data, 'address_id');
        return TRUE;
    }

}
