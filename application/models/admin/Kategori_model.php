<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_aktif()
    {
        $sql = "select * from kategori_barang where aktif=1 and delete_status=0";
        return $this->db->query($sql);
    }

    public function get_root_kategori_aktif()
    {
        $sql = "select * from kategori_barang where parent_id =0 and aktif=1 and delete_status=0";
        return $this->db->query($sql);
    }

    public function get_root_kategori()
    {
        $sql = "select * from kategori_barang where parent_id =0 and delete_status=0";
        return $this->db->query($sql);
    }

    public function get_one_by_id($id_kategori)
    {
        $sql = "select * from kategori_barang where id_kategori =$id_kategori and delete_status=0";
        return $this->db->query($sql);
    }

    public function get_kategori_dihapus()
    {
        $sql = "select * from kategori_barang where delete_status =1";
        return $this->db->query($sql);
    }

    public function get_by_id($id_kategori)
    {
        $sql = "select *, (select nama_kategori from kategori_barang where id_kategori = kat_brg.parent_id) as parent_kategori from kategori_barang as kat_brg where id_kategori = $id_kategori and delete_status=0";
        return $this->db->query($sql);
    }

    public function get_subkategori_by_parentid($parent_id)
    {
        $sql = "select *,(select nama_kategori from kategori_barang where id_kategori = kat_brg.parent_id) as parent_kategori from kategori_barang as kat_brg where parent_id=$parent_id and delete_status=0";
        return $this->db->query($sql);
    }

    public function get_kategori_aktif()
    {
        $sql = "select * from kategori_barang where aktif=1 and delete_status=0";
        return $this->db->query($sql);
    }

    public function create($data)
    {
        $query=$this->db->insert_batch('kategori_barang',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('kategori_barang', $data, 'id_kategori');
        return TRUE;
    }

    function delete($id_kategori)
    {
     //   $this->db->delete('katedgori_barang', $id_kategori);
        $this->db->where_in('id_kategori', $id_kategori);
        $this->db->delete('kategori_barang');
        return TRUE;
    }

}
