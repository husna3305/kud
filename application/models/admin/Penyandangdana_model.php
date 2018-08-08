<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyandangdana_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_aktif()
    {
        $sql = "select penyandang_dana.* from penyandang_dana where penyandang_dana.deleted_status=0 and aktif=1";
        return $this->db->query($sql);
    }

    public function get_by_id_aktif($id_penyandangdana)
    {
        $sql = "select penyandang_dana.* from penyandang_dana where penyandang_dana.id_penyandangdana=$id_penyandangdana and penyandang_dana.deleted_status=0 and aktif=1";
        return $this->db->query($sql);
    }

    public function get_kelompoktani_dihapus()
    {
        $sql = "select penyandang_dana.* from penyandang_dana where penyandang_dana.deleted_status=1";
        return $this->db->query($sql);
    }
    
    public function create($data)
    {
        $query=$this->db->insert_batch('penyandang_dana',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('penyandang_dana', $data, 'id_penyandangdana');
        return TRUE;
    }

    function delete($id_penyandangdana)
    {
        $this->db->where_in('id_penyandangdana', $id_penyandangdana);
        $this->db->delete('penyandang_dana');
        return TRUE;
    }

}
