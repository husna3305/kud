<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $sql = "select suplier.* from suplier where suplier.deleted_status=0";
        return $this->db->query($sql);
    }

    public function get_all_aktif()
    {
        $sql = "select suplier.* from suplier where suplier.aktif=1 and suplier.deleted_status=0";
        return $this->db->query($sql);
    }

    public function get_by_id($id_suplier)
    {
        $sql = "select suplier.* from suplier where suplier.id_suplier=$id_suplier and suplier.deleted_status=0";
        return $this->db->query($sql);
    }

    public function get_suplier_dihapus()
    {
        $sql = "select suplier.* from suplier where suplier.deleted_status=1";
        return $this->db->query($sql);
    }
    
    public function create($data)
    {
        $query=$this->db->insert_batch('suplier',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('suplier', $data, 'id_suplier');
        return TRUE;
    }

    function delete($id_suplier)
    {
        $this->db->where_in('id_suplier', $id_suplier);
        $this->db->delete('suplier');
        return TRUE;
    }

}
