<style type="text/css">
  .hide{
    display: none;
  }
  .show{
    display: block !important;
  }
</style>

<!--<div id="show_harga_jual_tunai" style="display: block;">
  <table class="table table-bordered table-hover table-condensed table-striped" >
  <thead style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr>
      <th style="text-align: center;vertical-align: middle;"><button class="btn btn-link" id="btn_hapus_semua_barang"><i class="fa fa-times" style="color: white"></i></button></th>
      <th style="text-align: center;vertical-align: middle;width: 40%">Uraian Data Barang</th>
      <th style="text-align: center;vertical-align: middle;">Qty</th>
      <th style="text-align: center;vertical-align: middle;">Harga Satuan</th>
      <th style="text-align: center;vertical-align: middle;">Subtotal</th>
    </tr>
  </thead>
  <tbody>
      <?php if ($this->cart1->get_content()): ?>
          <?php foreach ($this->cart1->get_content() as $items): ?>
        <tr>
          <td style="vertical-align: middle;text-align: center">
            <button class="btn btn-link btn_hapus_barang" rowid="<?php echo $items['rowid'] ?>"><i class="fa fa-times"></i></button>
          </td>
          <td style="vertical-align: middle;">
              Nama Barang : <?php echo $items['name'] ?><br>
              Kategori : <?php echo $items['kategori'] ?>
            
          </td>
          <td style="vertical-align: middle; width: 13%" align="center"><button class="btn btn-info form-control btn_upd_qty" data-id="<?php echo $items['id'] ?>" data-qty="<?php echo $items['qty'] ?>" data-toggle="modal" data-target=".modal_upd_qty"><?php echo $this->cart->format_number($items['qty']); ?></button></td>
          <td style="vertical-align: middle;text-align: center">Rp.&nbsp;<?php echo $this->cart->format_number($items['harga_jual_tunai']); ?></td>
          <td style="vertical-align: middle;text-align: center">Rp.&nbsp;<?php echo $this->cart->format_number($items['total']) ?></td>
        </tr>
      <?php endforeach ?>
      <?php endif ?>
  </tbody>
    <tfoot style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr>
      <td colspan="2">Total Jumlah Barang</td>
      <td style="text-align: center;font-size: 18px"><?php echo $this->cart->format_number($this->cart1->total_articles()); ?></td>
      <td>Total Pembayaran</td><td align="center" style="font-size: 18px">Rp. <?php echo $this->cart->format_number($this->cart1->total_cart()); ?></td>
    </tr>
    <tr id="total_angsuran_perpembayaran" style="display: none">
      <td colspan="4">Total Pembayaran + Penambahan Biaya Angsuran</td>
      <td><span id="hasil_penambahan_biaya_angsuran" class="priceformat" style="font-size: 19px;text-align: center;vertical-align: middle;"></span></td>
    </tr>
  </tfoot>
</table>
</div>
-->

<div id="show_penjualan">
  <table class="table table-bordered table-hover table-condensed table-striped" style="margin-bottom: 5px">
  <thead style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr>
      <th style="text-align: center;vertical-align: middle;"><button class="btn btn-link" id="btn_hapus_semua_barang"><i class="fa fa-times" style="color: white"></i></button></th>
      <th style="text-align: center;vertical-align: middle;width: 40%">Uraian Data Barang</th>
      <th style="text-align: center;vertical-align: middle;">Qty</th>
      <th style="text-align: center;vertical-align: middle;" class="harga_tunai hide">Harga Satuan</th>
      <th style="text-align: center;vertical-align: middle;" class="harga_angsuran hide">Harga Satuan Angsuran</th>
      <th style="text-align: center;vertical-align: middle;" class="insentif_perbarang hide">Insentif</th>
      <th style="text-align: center;vertical-align: middle;" class="subtotal ">Subtotal</th>
    </tr>
  </thead>
  <tbody>
       <?php 
            $subtotal_tunai=0;
            $subtotal_angsuran=0;
            
            $total_tunai=0;
            $total_angsuran=0;
            $total_tunai_insentifperbang=0;
            
            $total_angsuran_insentifperbang=0;
           ?>
      <?php if ($this->cart1->get_content()): ?>
          <?php foreach ($this->cart1->get_content() as $items): ?>
        <tr>
          <td style="vertical-align: middle;text-align: center">
            <button class="btn btn-link btn_hapus_barang" rowid="<?php echo $items['rowid'] ?>"><i class="fa fa-times"></i></button>
          </td>
          <td style="vertical-align: middle;">
              Nama Barang : <?php echo $items['name'] ?><br>
              Kategori : <?php echo $items['kategori'] ?>
            
          </td>
          <td style="vertical-align: middle; width: 13%" align="center"><button class="btn btn-info form-control btn_upd_qty" data-id="<?php echo $items['id'] ?>" data-qty="<?php echo $items['qty'] ?>" data-toggle="modal" data-target=".modal_upd_qty"><?php echo $this->cart->format_number($items['qty']); ?></button></td>

          <td style="vertical-align: middle;text-align: center" class="harga_tunai hide">Rp.&nbsp;<?php echo $this->cart->format_number($items['harga_jual_tunai']); ?></td>
          
          <td style="vertical-align: middle; width: 20%" align="center" class="harga_angsuran hide">
            <button class="btn btn-info form-control btn_upd_angsuran" data-rowid="<?php echo $items['rowid'] ?>" data-harga_jual_angsur="<?php echo $items['harga_jual_angsur'] ?>" data-toggle="modal" data-target=".modal_upd_harga_jual_angsur"><?php echo $this->cart->format_number($items['harga_jual_angsur']); ?></button>
          </td>
           <td style="vertical-align: middle; width: 20%" align="center" class="insentif_perbarang hide">
            <button class="btn btn-info form-control btn_upd_angsuran insentif_perbarang hide" data-rowid="<?php echo $items['rowid'] ?>" data-harga_jual_angsur="<?php echo $items['harga_jual_angsur'] ?>" data-toggle="modal" data-target=".modal_upd_harga_jual_angsur">s</button>
          </td>

          <?php $subtotal_tunai = $items['qty']*($items['harga_jual_tunai']+$items['insentif']) ?>
          <?php $subtotal_angsuran = $items['qty']*($items['harga_jual_angsur']+$items['insentif']) ?>


          <td style="vertical-align: middle;text-align: center" class="subtotal_tunai hide">Rp.&nbsp;<?php echo $this->cart->format_number($subtotal_tunai) ?></td>

          <td style="vertical-align: middle;text-align: center" class="subtotal_tunai_insentif_perbarang hide">Rp.&nbsp;<?php echo $this->cart->format_number($subtotal_tunai) ?></td>

          <td style="vertical-align: middle;text-align: center" class="subtotal_angsuran hide">Rp.&nbsp;<?php echo $this->cart->format_number($subtotal_angsuran) ?></td>

          <td style="vertical-align: middle;text-align: center" class="subtotal_angsuranperpembayaran_intensifpembayaran hide">Rp.&nbsp;<?php echo $this->cart->format_number($subtotal_angsuran) ?></td>


          <td style="vertical-align: middle;text-align: center" class="subtotal_angsuran_insentif_perbarang hide">Rp.&nbsp;<?php echo $this->cart->format_number($subtotal_angsuran) ?></td>
        </tr>
        <?php $total_tunai = $total_tunai+$subtotal_tunai; ?>
        <?php $total_angsuran = $total_angsuran+$subtotal_angsuran; ?>
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
    <td>Total Jumlah Barang</td><td>:</td><td><?php echo $this->cart->format_number($this->cart1->total_articles()); ?></td>
  </tr>

  <tr style="font-weight: bold;" class="total_tunai hide">
    <td>Total Pembayaran Tunai</td><td>:</td><td><?php echo $this->cart->format_number($total_tunai) ?></td>
  </tr>

  <tr style="font-weight: bold;" class="total_angsuranperbarang hide">
    <td>Total Pembayaran Angsuran</td><td>:</td><td><?php echo $this->cart->format_number($total_angsuran) ?></td>
  </tr>
  <tr style="font-weight: bold;" class="total_angsuranperpembayaran hide">
    <td>Total Pembayaran Angsuran</td><td>:</td><td><?php echo $this->cart->format_number($total_angsuran) ?></td>
  </tr>
  <tr style="font-weight: bold;" class="total_angsuranperbarang_intensifperbarang hide">
    <td>Total Pembayaran Angsuran</td><td>:</td><td><?php echo $this->cart->format_number($total_angsuran) ?></td>
  </tr>
  <tr style="font-weight: bold;" class="total_angsuranperbarang_intensifpembayaran hide">
    <td>Total Pembayaran Angsuran Perbarang + Insentif Perpembayaran</td><td>:</td><td><?php echo $this->cart->format_number($total_angsuran) ?></td>
  </tr>
  <tr style="font-weight: bold;" class="total_angsuranpembayaran_intensifperbarang hide">
    <td>Total Pembayaran Angsuran</td><td>:</td><td><?php echo $this->cart->format_number($total_angsuran) ?></td>
  </tr>
  <tr style="font-weight: bold;" class="total_angsuranperpembayaran_intensifpembayaran hide">
    <td>Total Pembayaran Angsuran Perbarang + Insentif Perpembayaran</td><td>:</td><td><?php echo $this->cart->format_number($total_angsuran) ?></td>
  </tr>
  <tr style="font-weight: bold;" class="total_tunai_insentifperbarang hide">
    <td>Total Pembayaran Tunai Insentif Barang</td><td>:</td><td><?php echo $this->cart->format_number($total_tunai_insentifperbang) ?></td>
  </tr>
  <tr style="font-weight: bold;" class="total_tunai_insentifperpembayaran hide">
    <td>Total Pembayaran Tunai Insentif Per Pembayaran</td><td>:</td><td><?php echo $this->cart->format_number($total_tunai_insentifperbang) ?></td>
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
<input type="hidden" name="total_barang" id="total_barang" value="<?php echo $this->cart1->total_articles() ?>">

<script type="text/javascript">
  $(document).ready(function(){
    var total_barang = parseInt(<?php echo $this->cart1->total_articles() ?>);
    // Cek Total Barang
    if (total_barang==0) {
      $("#div_input_data_penjualan").addClass("disablediv");
    }else{
      $("#div_input_data_penjualan").removeClass("disablediv");
    }
    // End Of Cek Total Barang

    // Cek Jenis Pembayaran
    if ($('#check_jenispembayaran').is(":checked")) 
    {
      // Cek Jenis Insentif
      if ($('#check_insentif').is(":checked"))
      {
        if ($('#check_jenisinsentif').is(":checked"))
        {
          $(".total_tunai_insentifperpembayaran").removeClass("hide");
          $(".harga_tunai").removeClass("hide");
          $(".subtotal_tunai").removeClass("hide");

        }
        else
        {
          $(".total_tunai_insentifperbarang").removeClass("hide");
          $(".insentif_perbarang").removeClass("hide");
          $(".harga_tunai").removeClass("hide");
          $(".subtotal_tunai_insentif_perbarang").removeClass("hide");

        }
      }
      else
      {
        $(".harga_tunai").removeClass("hide");
        $(".total_tunai").removeClass("hide");
        $(".subtotal_tunai").removeClass("hide");
      }
      // End Of Cek Jenis Insentif
    }
    else
    {
      if ($('#check_jenisangsuran').is(":checked"))
      {
        // Cek Jenis Insentif
        if ($('#check_insentif').is(":checked"))
        {
          if ($('#check_jenisinsentif').is(":checked"))
          {
            $(".total_angsuranperpembayaran_intensifpembayaran").removeClass("hide");
  
            $(".subtotal_angsuranperpembayaran_intensifpembayaran").removeClass("hide");
          }
          else
          {
            $(".total_tunai_insentifperbarang").removeClass("hide");
            $(".insentif_perbarang").removeClass("hide");
            $(".harga_tunai").removeClass("hide");
            $(".subtotal_tunai_insentif_perbarang").removeClass("hide");
  
          }
        }
        else
        {
          $(".harga_angsuran").removeClass("hide");
          $(".total_angsuranperpembayaran").removeClass("hide");
          $(".subtotal_angsuran").removeClass("hide");

        }
        // End Of Cek Jenis Insentif
      }
      else
      {
        //$(".harga_angsuran").removeClass("hide");
      }
    }

   }) 
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