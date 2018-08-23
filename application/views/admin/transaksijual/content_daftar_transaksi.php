<style type="text/css">
  .hide{
    display: none;
  }
  .show{
    display: block !important;
  }
</style>

<div id="show_penjualan">
  <?php
  if ($header_transaksi->num_rows() > 0)
  {
      $ht=$header_transaksi->row();
      $jenis_insentif = $ht->jenis_insentif;
      $jenis_pembayaran = $ht->jenis_pembayaran;
      $jenis_angsuran = $ht->jenis_angsuran;
  } ?>

  <table class="table table-bordered table-hover table-condensed table-striped" style="margin-bottom: 5px">
  <thead style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr>
      <th style="text-align: center;vertical-align: middle;"><button class="btn btn-link" id="btn_hapus_semua_barang"><i class="fa fa-times" style="color: white"></i></button></th>
      <th style="text-align: center;vertical-align: middle;width: 40%">Uraian Data Barang</th>
      <th style="text-align: center;vertical-align: middle;">Qty</th>
      <?php if ($jenis_pembayaran=='tunai'): ?>
        <th style="text-align: center;vertical-align: middle;">Harga Satuan</th>
      <?php endif ?>
      <?php if ($jenis_angsuran =='per_barang' AND $jenis_pembayaran="angsur"): ?>
        <th style="text-align: center;vertical-align: middle;">Harga Satuan Angsuran</th>
      <?php endif ?>
      <?php if ($jenis_angsuran =='per_pembayaran' AND $jenis_pembayaran="angsur"): ?>
        <th style="text-align: center;vertical-align: middle;">Harga Satuan</th>
      <?php endif ?>

      <?php if ($jenis_insentif =='per_barang'): ?>
        <th style="text-align: center;vertical-align: middle;">Insentif</th>
      <?php endif ?>
      <th style="text-align: center;vertical-align: middle;" class="subtotal ">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php  $total_qty=0;$total_tunai =0; if ($detail_transaksi->num_rows() > 0): ?>
      <?php foreach ($detail_transaksi->result() as $dt): ?>

          <tr>

            <td style="vertical-align: middle;text-align: center">
              <button class="btn btn-link btn_hapus_barang" onclick="deleteDetail(<?php echo $dt->id_stok ?>)"><i class="fa fa-times"></i></button>
            </td>

            <td style="vertical-align: middle;">
              Nama Barang : <?php echo $dt->nama_barang ?><br>
              Kategori : <?php echo $dt->root_kategori ?><?php if ($dt->parent<>0): ?>,&bsp;
                <?php endif ?> <?php echo $dt->nama_kategori ?>
            
            </td>

            <td style="vertical-align: middle; width: 13%" align="center">
              <button class="btn btn-info form-control btn_upd_qty" data-id_stok="<?php echo $dt->id_stok ?>" data-qty="<?php echo $dt->qty ?>" data-toggle="modal" data-target=".modal_upd_qty"><?php echo $this->cart->format_number($dt->qty); ?></button>
            </td>

            <?php if ($jenis_pembayaran=='tunai'): ?>
              <td align="center" style="vertical-align: middle;">Rp. <?php echo $this->cart->format_number($dt->harga_jual_tunai) ?></td>
            <?php endif ?>
            <?php if ($jenis_pembayaran=='angsur' and $jenis_angsuran=='per_barang'): ?>
              <td align="center" style="vertical-align: middle;">Rp. <?php echo $this->cart->format_number($dt->harga_jual_angsur) ?></td>
            <?php endif ?>
            <?php if ($jenis_angsuran =='per_pembayaran' AND $jenis_pembayaran="angsur"): ?>
 <td align="center" style="vertical-align: middle;">Rp. <?php echo $this->cart->format_number($dt->harga_jual_tunai) ?></td>
            <?php endif ?>

            <?php 
              if ($jenis_pembayaran=='tunai') {
                  $subtotal = $dt->harga_jual_tunai * $dt->qty;
              }elseif ($jenis_pembayaran=='angsur' and $jenis_angsuran=='per_barang') {
                  $subtotal = $dt->harga_jual_angsur * $dt->qty;
              }elseif($jenis_pembayaran=='tunai' AND $jenis_insentif='per_barang' ){
                  $subtotal = ($dt->harga_jual_tunai * $dt->qty) - ($dt->insentif*$dt->qty);
              }elseif($jenis_pembayaran=='angsur' AND $jenis_insentif='per_barang' ){
                  $subtotal = ($dt->harga_jual_angsur * $dt->qty) - ($dt->insentif*$dt->qty);
              }
            ?>

            <td style="text-align: center;vertical-align: middle;">Rp. <?php echo $this->cart->format_number($subtotal); ?></td>
          </tr>
          <?php $total_tunai = $subtotal +$total_tunai;
                $total_qty = $total_qty + $dt->qty;
          ?>
      <?php endforeach ?>
    <?php endif ?>
  </tbody>
  <!--
    <tfoot style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr class="tunai" style="display: block !mportant;">
      <td colspan="2">Total Jumlah Barang</td>
      <td style="text-align: center;font-size: 18px"><?php echo $this->cart->format_number($this->cart1->total_articles()); ?></td>
      <td >Total Pembayaran</td>
      <td align="center" style="font-size: 18px">
        Rp. <?php if($this->cart1->total_articles() >0){ $this->cart->format_number($total);} ?><input type="hidden" id="total_pembayaran" value="<?php echo $this->cart1->total_cart() ?>" ></td>
    </tr>
  </tfoot>
-->
</table>

<table width="70%" style="min-height: 50px;margin-left: 20px">
  <tr style="font-weight: bold;">
    <td>Total Jumlah Barang</td><td>:</td><td><?php echo $this->cart->format_number($total_qty); ?></td>
  </tr>

  <tr style="font-weight: bold;" class="total_tunai hide">
    <td>Total Pembayaran</td><td>:</td><td>Rp. <?php echo $this->cart->format_number($total_tunai) ?></td>
  </tr>
</table>

</div>
<!-- Modal Qty -->
<div class="modal fade modal_upd_qty">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Qty</h4>
      </div>
      <div class="modal-body">
                <input type="text" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="input_upd_qty" id="input_upd_qty">
                <label style="font-size: 12px;color: red"><i>Jika Diisi lebih kecil dari 1 maka data akan terhapus</i></label>
          <input type="text" name="id" class="form-control" id="id">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary btn_upd_new_qty"><i class="fa fa-save"></i> &nbsp;Simpan</button>
         <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- End Of Modal Qty -->
<script type="text/javascript">

  $('.btn_hapus_barang').on('click',function(e){
  //$(document).on("click",".btn_hapus_barang",function(){
      var rowid=$(this).attr('rowid');
      $.ajax({
           url:"<?php echo site_url('admin/transaksijual/hapus_barang');?>",
           type:"POST",
           data:"rowid="+rowid
                +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
           cache:false,
           success:function(html){
              $("#show_daftar_transaksijual").html(html);
           }
      });
  })

  $('.btn_upd_new_qty').on('click',function(e){
  //$(document).on("click",".btn_upd_new_qty",function(e){
    e.preventDefault();      
      var id=$('.modal_upd_qty #id').val();
     var input_upd_qty=$('.modal_upd_qty #input_upd_qty').val();
      var input_upd_qty=$('.modal_upd_qty #input_upd_qty').val();
      var id=$('.modal_upd_qty #id').val();
      $.ajax({
           url:"<?php echo site_url('admin/transaksijual/update_qty');?>",
           type:"POST",
           data:"id="+id
                +"&qty="+input_upd_qty
                +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
           cache:false,
           success:function(html){
              $("#show_daftar_transaksijual").html(html);
              $(".modal_upd_qty").modal("hide");
              $(".modal-backdrop").remove();
              $('.modal_upd_qty #id').val('');
              $('.modal_upd_qty #input_upd_qty').val('');
           }
      });
    
  })

  $('#btn_hapus_semua_barang').on('click',function(e){
  //$(document).on("click","#btn_hapus_semua_barang",function(){
      swal({
        title: 'Apakah anda Yakin Menghapus Data Dalam Daftar Transaksi Penjualan ?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: false
      }).then((result) => {
        if (result.value) {
          $.ajax({
               url:"<?php echo site_url('admin/transaksijual/hapus_semua_barang');?>",
               type:"POST",
               data:"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#show_daftar_transaksijual").html(html);
               }
          });
        }
      }); //End Of Swal
  })

  // Load Modal Cari Suplier
  $('.modal_upd_qty').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var qty = $(e.relatedTarget).data('qty');
    $('.modal_upd_qty #id').val(id);
    $('.modal_upd_qty #input_upd_qty').val(qty);
  });
  // End Of Load Modal Cari Suplier
</script>