<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
//Transaksi Belanja Barang
    public function get_all_transaksi_bayar_header()
    {
        $sql = "select transaksi_belanja_header.*,suplier.nama_suplier,users.first_name,users.last_name from transaksi_belanja_header 
                join suplier on transaksi_belanja_header.id_suplier = suplier.id_suplier
                join users on transaksi_belanja_header.`user_id-add`=users.id
                where transaksi_belanja_header.deleted_status=0 order by transaksi_belanja_header.tanggal desc";
        return $this->db->query($sql);
    }

    public function get_all_transaksi_bayar_header_bysuplier()
    {
        $sql = "select suplier.id_suplier as suplier, suplier.nama_suplier,
                (select count(id) from transaksi_belanja_header where transaksi_belanja_header.id_suplier = suplier and transaksi_belanja_header.deleted_status=0) as jml_transaksi
                from suplier where suplier.deleted_status=0 order by suplier.nama_suplier";
        return $this->db->query($sql);
    }

    public function get_all_transaksi_belanja_bybarang()
    {
        $sql = "select barang.id_barang as barang, barang.nama_barang, (select count(id_barang) from transaksi_belanja_detail where transaksi_belanja_detail.id_barang = barang and transaksi_belanja_detail.deleted_status=0) as jml_transaksi from barang where barang.delete_status=0 order by barang.nama_barang";
        return $this->db->query($sql);
    }

    public function get_by_periode_all_transaksi_belanja_detail_bybarang($id_barang,$tgl_mulai, $tgl_selesai)
    {
        $sql = "select * from transaksi_belanja_detail 
                join transaksi_belanja_header on transaksi_belanja_detail.id_transaksi_belanja=transaksi_belanja_header.id_transaksi_belanja 
                join barang on transaksi_belanja_detail.id_barang=barang.id_barang
                where transaksi_belanja_detail.deleted_status=0 
                and transaksi_belanja_detail.id_barang = $id_barang 
                and tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' 
                order by tanggal desc";
        return $this->db->query($sql);
    }
/*
    public function get_all_transaksi_bayar_header_bysuplierdetail($id_suplier)
    {
        $sql = "select transaksi_belanja_header.*,suplier.*,users.first_name,users.last_name from transaksi_belanja_header 
                join suplier on transaksi_belanja_header.id_suplier = suplier.id_suplier
                join users on transaksi_belanja_header.`user_id-add`=users.id
                where transaksi_belanja_header.deleted_status=0 and transaksi_belanja_header.id_suplier=$id_suplier order by transaksi_belanja_header.id_transaksi_belanja desc";
        return $this->db->query($sql);
    }
*/
    public function get_all_deleted_transaksi_bayar_header()
    {
        $sql = "select transaksi_belanja_header.*,suplier.nama_suplier,users.first_name,users.last_name from transaksi_belanja_header 
                join suplier on transaksi_belanja_header.id_suplier = suplier.id_suplier
                join users on transaksi_belanja_header.`user_id-add`=users.id
                where transaksi_belanja_header.deleted_status=1 order by transaksi_belanja_header.tanggal desc";
        return $this->db->query($sql);
    }
    public function get_transaksi_belanja_header_terakhir($tgl)
    {
        $sql = "select max(`id_transaksi_belanja`) as max_id FROM `transaksi_belanja_header` where `tanggal` = '$tgl'";
        return $this->db->query($sql);
    }

    public function get_transaksi_belanja_header_terakhir_by_userid()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $sql = "select max(`id_transaksi_belanja`) as max_id FROM `transaksi_belanja_header` where `user_id-add` = $user_id";
        return $this->db->query($sql);
    }

    public function get_transaksi_bayar_header($id_transaksi_belanja)
    {
        $sql = "select * FROM `transaksi_belanja_header` 
                left join suplier on `transaksi_belanja_header`.`id_suplier` = `suplier`.`id_suplier`
                where id_transaksi_belanja='$id_transaksi_belanja'";
        return $this->db->query($sql);
    }

    public function get_by_id_transaksi_bayar_header($id)
    {
        $sql = "select * FROM `transaksi_belanja_header` where id='$id'";
        return $this->db->query($sql);
    }

    public function get_by_id_suplier_transaksi_bayar_header($id_suplier,$tgl_mulai,$tgl_selesai)
    {
        $sql = "select *,transaksi_belanja_header.id_transaksi_belanja as id_trans, transaksi_belanja_header.id_suplier as id_splr,
                (select count(id_transaksi_belanja) from transaksi_belanja_detail where id_transaksi_belanja=id_trans) as count_detail

                FROM `transaksi_belanja_header` 
                join suplier on transaksi_belanja_header.id_suplier = suplier.id_suplier
                where transaksi_belanja_header.id_suplier=$id_suplier and tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ";
        return $this->db->query($sql);
    }

    public function get_transaksi_bayar_detail($id_transaksi_belanja)
    {
        $sql = "select transaksi_belanja_detail.*, barang.*, kategori_barang.nama_kategori, kategori_barang.parent_id as parent, (select nama_kategori from kategori_barang where id_kategori=parent) as root_kategori 
                FROM `transaksi_belanja_detail` 
                left join barang on transaksi_belanja_detail.id_barang = barang.id_barang
                left join kategori_barang on barang.id_kategori = kategori_barang.id_kategori
                where id_transaksi_belanja='$id_transaksi_belanja'";
        return $this->db->query($sql);
    }

    public function get_id_transaksi_belanja_by_suplier($id_suplier,$tgl_mulai,$tgl_selesai)
    {
        $sql = "select GROUP_CONCAT(id_transaksi_belanja ORDER BY id ASC SEPARATOR ', ') AS id_trans, count(id) as count from transaksi_belanja_header where id_suplier=$id_suplier  and tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ";
        return $this->db->query($sql);
    }

    public function get_transaksi_bayar_detail_multi_id_transaksi($id_transaksi_belanja)
    {
        $id = str_replace(' ','',$id_transaksi_belanja);
        $id_transaksi_belanja_expl = explode(',', $id);

        $this->db->join('barang', 'transaksi_belanja_detail.id_barang = barang.id_barang');
        //$this->db->where("tanggal BETWEEN $id_transaksi_belanja AND $tgl_selesai");
        $this->db->where_in('id_transaksi_belanja', $id_transaksi_belanja_expl);
        $this->db->order_by("id_transaksi_belanja", "desc");
        $query = $this->db->get('transaksi_belanja_detail');
        return $query;

       // $sql = "select * from tradnsaksi_belanja_detail where id_transaksi_belanja in($id_transaksi_belanja)";
        //return $this->db->query($sql);
    }

    public function get_transaksi_bayar_detail_multi_id_transaksi_limit($id_transaksi_belanja,$start, $end)
    {
        $id = str_replace(' ','',$id_transaksi_belanja);
        $id_transaksi_belanja_expl = explode(',', $id);

        $this->db->where_in('id_transaksi_belanja', $id_transaksi_belanja_expl);
        $this->db->limit($end, $start);
        $query = $this->db->get('transaksi_belanja_detail');
        return $query;
    }

    public function get_count_transaksi_belanja_by_id_transaksi_belanja($id_transaksi_belanja)
    {
        $query = $this->db->query("select count(id_transaksi_belanja) as count_transaksi from transaksi_belanja_detail where id_transaksi_belanja = '$id_transaksi_belanja'");
        return $query;
    }

    public function create_transaction_belanja($data)
    {

        $this->db->trans_begin();
            $this->db->insert_batch('transaksi_belanja_header',$data['transaksi_header']);
            $this->db->insert_batch('transaksi_belanja_detail',$data['transaksi_detail']);
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

    function update_transaksi_belanja_header($data)
    {
        $this->db->trans_begin();

            $this->db->update_batch('transaksi_belanja_header', $data['header'], 'id');
            $this->db->update_batch('stok_barang', $data['stok'], 'id_stok');
            $this->db->update_batch('transaksi_belanja_detail', $data['detail'], 'id_detail');

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
 function delete_transaksi_belanja_header($data)
    {
        $this->db->trans_begin();

            $this->db->where_in('id', $data['header']);
            $this->db->delete('transaksi_belanja_header');

            $this->db->where_in('id_detail', $data['detail']);
            $this->db->delete('transaksi_belanja_detail');

            $this->db->where_in('id_stok', $data['stok']);
            $this->db->delete('stok_barang');


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

//End Of Transaksi Belanja Barang




//Transaksi Penjualan
    public function get_transaksi_penjualan_header_terakhir($tgl)
    {
        $sql = "select max(`id_transaksi_penjualan`) as max_id FROM `transaksi_penjualan_header` where `tanggal` = '$tgl'";
        return $this->db->query($sql);
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
