<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_tmp_model extends CI_Model {
    var $table_header ="transaksi_penjualan_header_tmp";
    var $table_detail ="transaksi_penjualan_detail_tmp";
    public function __construct()
    {
        parent::__construct();
    }

//Transaksi Penjualan
    public function getAllHeader()
    {
        $sql = "SELECT * FROM $this->table_header";
        return $this->db->query($sql);
    }
    public function getAllDetail()
    {
        $sql = "SELECT *,  kategori_barang.nama_kategori, kategori_barang.parent_id as parent, (select nama_kategori from kategori_barang where id_kategori=parent) as root_kategori  FROM $this->table_detail
                left join barang on $this->table_detail.id_barang=barang.id_barang
                left join kategori_barang on barang.id_kategori = kategori_barang.id_kategori
                ";
        return $this->db->query($sql);
    }

    public function delAllTmp()
    {

        $this->db->trans_begin();
            $this->db->query("DELETE FROM $this->table_header");
            $this->db->query("DELETE FROM $this->table_detail");

            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    return FALSE;
            }
            else
            {
                    $this->db->trans_commit();
                    return TRUE;
            }
    }

    public function InsertHeaderTransaction($data)
    {
        $this->db->insert("$this->table_header",$data);
    }

    public function insertDetail($data)
    {
        $this->db->insert("$this->table_detail",$data);
    }

    public function updJenisPembayaran($a, $b)
    {
       $this->db->query("UPDATE $this->table_header set jenis_pembayaran='$a', jenis_angsuran='$b'") ;
    }






    public function get_all_transaksi_penjualan_header()
    {
        $sql ="select transaksi_penjualan_header.*, users.first_name,users.last_name from transaksi_penjualan_header 
                left join kelompok_tani on transaksi_penjualan_header.kelompoktani = kelompok_tani.id_kelompok_tani
                left join konsumen_pribadi on transaksi_penjualan_header.kelompoktani = konsumen_pribadi.id_konsumenpribadi
                left join users on transaksi_penjualan_header.`user_id-add`=users.id
                ";
        return $this->db->query($sql);
    }

    public function get_all_transaksi_penjualan_header_bykelompoktani()
    {
        $sql = "select kelompok_tani.id_kelompok_tani as kelompok_tani, kelompok_tani.nama_kelompok_tani, (select count(id) from transaksi_penjualan_header where transaksi_penjualan_header.kelompoktani = kelompok_tani and transaksi_penjualan_header.deleted_status=0) as jml_transaksi from kelompok_tani where kelompok_tani.deleted_status=0 order by kelompok_tani.nama_kelompok_tani";
        return $this->db->query($sql);
    }

    public function get_transaksi_penjualan_header($id_transaksi_penjualan)
    {
        $sql ="select * from transaksi_penjualan_header 
                left join kelompok_tani on transaksi_penjualan_header.kelompoktani = kelompok_tani.id_kelompok_tani
                left join konsumen_pribadi on transaksi_penjualan_header.kelompoktani = konsumen_pribadi.id_konsumenpribadi
                where id_transaksi_penjualan= '$id_transaksi_penjualan'";
        return $this->db->query($sql);
    }

    public function get_transaksi_penjualan_detail_by_idtransaksipenjualan($id_transaksi_penjualan)
    {
        $sql ="select *, 
                kategori_barang.nama_kategori, kategori_barang.parent_id as parent, (select nama_kategori from kategori_barang where id_kategori=parent) as root_kategori 
                FROM `transaksi_penjualan_detail` 
                left join barang on transaksi_penjualan_detail.id_barang = barang.id_barang
                left join kategori_barang on barang.id_kategori = kategori_barang.id_kategori
               where id_transaksi_penjualan= '$id_transaksi_penjualan'";
        return $this->db->query($sql);
    }

    public function get_multi_id_transaksi_penjualan_bykelompoktani($kelompoktani,$tgl_mulai,$tgl_selesai)
    {
        $sql = "select GROUP_CONCAT(id_transaksi_penjualan ORDER BY id ASC SEPARATOR ', ') AS id_trans, count(id) as count from transaksi_penjualan_header where kelompoktani=$kelompoktani  and tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ";
        return $this->db->query($sql);
    }

    public function get_transaksi_penjualan_detail_multi_id_transaksi($id_transaksi_belanja)
    {
        $id = str_replace(' ','',$id_transaksi_belanja);
        $id_transaksi_penjualan_expl = explode(',', $id);

        $this->db->join('barang', 'transaksi_penjualan_detail.id_barang = barang.id_barang');
        $this->db->where_in('id_transaksi_penjualan', $id_transaksi_penjualan_expl);
        $this->db->order_by("id_transaksi_penjualan", "desc");
        $query = $this->db->get('transaksi_penjualan_detail');
        return $query;
    }

    public function get_by_kelompoktani_transaksi_penjualan_header($kelompoktani,$tgl_mulai,$tgl_selesai)
    {
        $sql = "select *,transaksi_penjualan_header.id_transaksi_penjualan as id_trans, transaksi_penjualan_header.kelompoktani as id_kelompok,
                (select count(id_transaksi_penjualan) from transaksi_penjualan_detail where id_transaksi_penjualan=id_trans) as count_detail

                FROM `transaksi_penjualan_header` 
                join kelompok_tani on transaksi_penjualan_header.kelompoktani = kelompok_tani.id_kelompok_tani
                where transaksi_penjualan_header.kelompoktani=$kelompoktani and tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ";
        return $this->db->query($sql);
    }

    public function create_transaction_penjualan($data)
    {

        $this->db->trans_begin();
            $this->db->insert_batch('transaksi_penjualan_header',$data['transaksi_header']);
            $this->db->insert_batch('transaksi_penjualan_detail',$data['transaksi_detail']);
            $this->db->insert_batch('stok_barang',$data['stok_barang']);

            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    return FALSE;
            }
            else
            {
                    $this->db->trans_commit();
                    return TRUE;
            }
    }
//End Of Transaksi Penjualan

}
