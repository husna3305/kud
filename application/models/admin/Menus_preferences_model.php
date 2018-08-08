<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus_preferences_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_all()
    {
        return $this->db->get('menus_preferences');
    }
    
    public function get_by_menuid_groupid ($menu_id, $group_id)
    {
        $sql = "select * from menus_preferences where menu_id = $menu_id and group_id = $group_id";
        return $this->db->query($sql);
    }

    public function get_by_groupid($group_id)
    {
        $sql = "select * from menus_preferences where group_id = $group_id";
        return $this->db->query($sql);
    }
    
    public function get_by_link_groupid_active($link, $group_id)
    {
        $sql = "select * from menus_preferences 
                join menus on menus_preferences.menu_id  = menus.menu_id
                where link = 'admin/$link' and group_id = $group_id and active='1'";
        return $this->db->query($sql);
    }

    public function get_by_link_groupidmulti_active($link, $group_id)
    {
        $sql = "select menus_preferences.* from menus_preferences 
                join menus on menus_preferences.menu_id  = menus.menu_id
                where link = 'admin/$link' and group_id in($group_id) and active='1'";
        return $this->db->query($sql);
    }
    
    public function get_by_link_groupid_active_show ($link, $group_id)
    {
        $sql = "select * from menus_preferences 
                join menus on menus_preferences.menu_id  = menus.menu_id
                where link = 'admin/$link' and group_id = $group_id and active='1' and menus_preferences.show = '1'";
        return $this->db->query($sql);
    }

    public function update_interfaces($table, $data)
    {
        $where = "id = 1";
        return $this->db->update($table, $data, $where);
    }
    
    public function create($data)
    {
        $query=$this->db->insert_batch('menus_preferences',$data);
    }
    
    function edit($data)
    {
        $this->db->update_batch('menus_preferences', $data, 'id'); 
    }

}
