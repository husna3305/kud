<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_tani_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_aktif()
    {
        $sql = "select kelompok_tani.* from kelompok_tani where kelompok_tani.deleted_status=0 and aktif=1";
        return $this->db->query($sql);
    }

    public function get_by_id_aktif($id_kelompok_tani)
    {
        $sql = "select kelompok_tani.* from kelompok_tani where kelompok_tani.id_kelompok_tani=$id_kelompok_tani and kelompok_tani.deleted_status=0 and aktif=1";
        return $this->db->query($sql);
    }

    public function get_kelompoktani_dihapus()
    {
        $sql = "select kelompok_tani.* from kelompok_tani where kelompok_tani.deleted_status=1";
        return $this->db->query($sql);
    }
    
    public function create($data)
    {
        $query=$this->db->insert_batch('kelompok_tani',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('kelompok_tani', $data, 'id_kelompok_tani');
        return TRUE;
    }

    function delete($id_kelompok_tani)
    {
        $this->db->where_in('id_kelompok_tani', $id_kelompok_tani);
        $this->db->delete('kelompok_tani');
        return TRUE;
    }

}
