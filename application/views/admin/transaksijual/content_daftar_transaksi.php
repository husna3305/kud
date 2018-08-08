<div id="show_harga_jual_tunai" style="display: block;">
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

<div id="show_harga_jual_angsur" style="display: none">
  <table class="table table-bordered table-hover table-condensed table-striped" >
  <thead style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr>
      <th style="text-align: center;vertical-align: middle;"><button class="btn btn-link" id="btn_hapus_semua_barang"><i class="fa fa-times" style="color: white"></i></button></th>
      <th style="text-align: center;vertical-align: middle;width: 40%">Uraian Data Barang</th>
      <th style="text-align: center;vertical-align: middle;">Qty</th>
      <th style="text-align: center;vertical-align: middle;">Harga Satuan Angsuran</th>
      <th style="text-align: center;vertical-align: middle;">Subtotal</th>
    </tr>
  </thead>
  <tbody>
      <?php if ($this->cart1->get_content()): ?>
          <?php 
            $subtotal=0;
            $total=0;
           ?>
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

          <td style="vertical-align: middle; width: 20%" align="center"><button class="btn btn-info form-control btn_upd_qty" data-rowid="<?php echo $items['rowid'] ?>" data-harga_jual_angsur="<?php echo $items['harga_jual_angsur'] ?>" data-toggle="modal" data-target=".modal_upd_harga_jual_angsur"><?php echo $this->cart->format_number($items['harga_jual_angsur']); ?></button></td>
          <?php $subtotal = $items['qty']*$items['harga_jual_angsur'] ?>
          <td style="vertical-align: middle;text-align: center">Rp.&nbsp;<?php echo $this->cart->format_number($subtotal) ?></td>
        </tr>
        <?php $total = $total+$subtotal; ?>
      <?php endforeach ?>
      <?php endif ?>
  </tbody>
    <tfoot style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr>
      <td colspan="2">Total Jumlah Barang</td>
      <td style="text-align: center;font-size: 18px"><?php echo $this->cart->format_number($this->cart1->total_articles()); ?></td>
      <td >Total Pembayaran</td><td align="center" style="font-size: 18px">Rp. <?php echo $this->cart->format_number($total) ?><input type="hidden" id="total_pembayaran" value="<?php echo $this->cart1->total_cart() ?>" ></td>
    </tr>
  </tfoot>
</table>
</div>
<!-- Modal Cari Barang -->
<div class="modal fade modal_upd_qty">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Jumlah Barang</h4>
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
<!-- End Of Modal Cari Barang -->
<input type="hidden" name="total_barang" id="total_barang" value="<?php echo $this->cart1->total_articles() ?>">

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