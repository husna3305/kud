<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_all()
    {
        $this->db->order_by("order", "asc");
        $query = $this->db->get('menus');

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
        $sql = "select * from menus where is_parent='1'";
        return $this->db->query($sql);
    }
    
    public function get_by_menuid($menu_id)
    {
        $sql = "select * from menus where menu_id=$menu_id";
        return $this->db->query($sql);
    }
    
    public function get_is_header()
    {
        $sql = "select * from menus where is_menu_header='1'";
        return $this->db->query($sql);
    }
    
    public function create($data)
    {
        $query=$this->db->insert_batch('menus',$data);
    }
    
    function update($data)
    {
        $this->db->update_batch('menus', $data, 'menu_id'); 
        return TRUE;
    }

    public function update_interfaces($table, $data)
    {
        $where = "id = 1";
        return $this->db->update($table, $data, $where);
    }

}
