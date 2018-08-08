<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumenpribadi_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_aktif()
    {
        $sql = "select konsumen_pribadi.* from konsumen_pribadi where konsumen_pribadi.deleted_status=0 and aktif=1";
        return $this->db->query($sql);
    }

    public function get_by_id_aktif($id_konsumenpribadi)
    {
        $sql = "select konsumen_pribadi.* from konsumen_pribadi where konsumen_pribadi.id_konsumenpribadi=$id_konsumenpribadi and konsumen_pribadi.deleted_status=0 and aktif=1";
        return $this->db->query($sql);
    }

    public function get_kelompoktani_dihapus()
    {
        $sql = "select konsumen_pribadi.* from konsumen_pribadi where konsumen_pribadi.deleted_status=1";
        return $this->db->query($sql);
    }
    
    public function create($data)
    {
        $query=$this->db->insert_batch('konsumen_pribadi',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('konsumen_pribadi', $data, 'id_konsumenpribadi');
        return TRUE;
    }

    function delete($id_konsumenpribadi)
    {
        $this->db->where_in('id_konsumenpribadi', $id_konsumenpribadi);
        $this->db->delete('konsumen_pribadi');
        return TRUE;
    }

}
