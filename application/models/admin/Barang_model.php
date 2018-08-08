<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

//Stok
    public function get_stok($id_barang)
    {
        $sql = "select stok_barang.*, stok_barang.id_stok as stok_id, barang.nama_barang,
        kategori_barang.nama_kategori,
                kategori_barang.parent_id as parent, 
                (select nama_kategori from kategori_barang where id_kategori=parent) as root_kategori,
(select harga_jual_tunai from transaksi_belanja_detail where id_barang=$id_barang and id_transaksi_belanja=stok_barang.keterangan_transaksi and transaksi_belanja_detail.deleted_status=0) as harga_jual_tunai,

(select harga_jual_angsur from transaksi_belanja_detail where id_barang=$id_barang and id_transaksi_belanja=stok_barang.keterangan_transaksi and transaksi_belanja_detail.deleted_status=0) as harga_jual_angsur,
(select harga_beli from transaksi_belanja_detail where id_barang=$id_barang and id_transaksi_belanja=stok_barang.keterangan_transaksi and transaksi_belanja_detail.deleted_status=0) as harga_beli,
(select sum(keluar) from stok_barang where id_stok_dikeluarkan=stok_id) as barang_keluar

from stok_barang

join barang on stok_barang.id_barang=barang.id_barang 
join kategori_barang on barang.id_kategori=kategori_barang.id_kategori

where stok_barang.id_barang=$id_barang and stok_barang.id_stok_dikeluarkan=0 and stok_barang.delete_status=0";
        return $this->db->query($sql);
    }

    public function get_stok_by_id_transaksi($keterangan_transaksi)
    {
        $sql ="select * from stok_barang where keterangan_transaksi = '$keterangan_transaksi'";
        return $this->db->query($sql);
    }


//End Of Stok

    public function get_all()
    {
        $sql = "select barang.*,barang.id_barang as barang,kategori_barang.nama_kategori,
                kategori_barang.parent_id as parent,
                (select nama_kategori from kategori_barang where id_kategori=parent) as root_kategori,
                (select sum(masuk) as jml_masuk from stok_barang where id_barang=barang and stok_barang.delete_status=0) as masuk,
                (select sum(keluar) as jml_keluar from stok_barang where id_barang=barang and stok_barang.delete_status=0) as keluar 
                from barang 
                join kategori_barang on barang.id_kategori=kategori_barang.id_kategori
                where barang.delete_status=0";
        return $this->db->query($sql);
    }

    public function get_by_id($id_barang)
    {
        $sql = "select barang.*,kategori_barang.nama_kategori, kategori_barang.parent_id as parent,
                (select nama_kategori from kategori_barang where id_kategori=parent) as root_kategori 
                from barang 
                join kategori_barang on barang.id_kategori=kategori_barang.id_kategori
                where barang.id_barang=$id_barang and barang.delete_status=0";
        return $this->db->query($sql);
    }

    public function get_barang_dihapus()
    {
        $sql = "select barang.*,kategori_barang.nama_kategori from barang 
                join kategori_barang on barang.id_kategori=kategori_barang.id_kategori
                where barang.delete_status=1";
        return $this->db->query($sql);
    }
    
    public function create($data)
    {
        $query=$this->db->insert_batch('barang',$data);
        return TRUE;
    }

    function update($data)
    {
        $this->db->update_batch('barang', $data, 'id_barang');
        return TRUE;
    }

    function delete($id_barang)
    {
        $this->db->where_in('id_barang', $id_barang);
        $this->db->delete('barang');
        return TRUE;
    }

}
