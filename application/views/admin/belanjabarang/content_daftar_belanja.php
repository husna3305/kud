<table class="table table-bordered table-hover table-condensed table-striped" >
  <thead style="font-weight: bold;font-size: 15px;background-color: #5ca1c7;color: white;">
    <tr>
      <th style="text-align: center;vertical-align: middle;"><button class="btn btn-link" id="btn_hapus_semua_barang"><i class="fa fa-times" style="color: white"></i></button></th>
      <th style="text-align: center;vertical-align: middle;">Uraian Data Barang</th>
      <th style="text-align: center;vertical-align: middle;">Qty</th>
      <th style="text-align: center;vertical-align: middle;">Harga Beli Satuan</th>
      <th style="text-align: center;vertical-align: middle;">Harga Jual Satuan</th>
      <th style="text-align: center;vertical-align: middle;">Harga Jual Angsuran</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($this->cart->contents() as $items): ?>
        <tr>
          <td style="vertical-align: middle;text-align: center">
            <button class="btn btn-link btn_hapus_barang" rowid="<?php echo $items['rowid'] ?>"><i class="fa fa-times"></i></button>
          </td>
          <td style="vertical-align: middle;">
              Nama Barang : <?php echo $items['name'] ?><br>
              Kategori : <?php echo $items['kategori'] ?>
            
          </td>
          <td style="vertical-align: middle; width: 13%" align="center"><button class="btn btn-info form-control btn_upd_qty" data-rowid="<?php echo $items['rowid'] ?>" data-qty="<?php echo $items['qty'] ?>" data-toggle="modal" data-target=".modal_upd_qty"><?php echo $this->cart->format_number($items['qty']); ?></button></td>
          <td style="vertical-align: middle;text-align: center">Rp.&nbsp;<?php echo $this->cart->format_number($items['harga_beli']); ?></td>
          <td style="vertical-align: middle;text-align: center">Rp.&nbsp;<?php echo $this->cart->format_number($items['harga_jual_tunai']); ?></td>
          <td style="vertical-align: middle;text-align: center">Rp.&nbsp;<?php echo $this->cart->format_number($items['harga_jual_angsur']); ?></td>
        </tr>
      <?php endforeach ?>
  </tbody>
</table>
<b>Total Jumlah barang : <?php echo $this->cart->format_number($this->cart->total_items()); ?></b>

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
          <input type="hidden" name="input_upd_qty" class="form-control" id="rowid">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary btn_upd_new_qty"><i class="fa fa-save"></i> &nbsp;Simpan</button>
         <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Barang -->
<input type="hidden" name="total_barang" id="total_barang" value="<?php echo $this->cart->total() ?>">

<script type="text/javascript">
  $(document).on("click",".btn_hapus_barang",function(){
      var rowid=$(this).attr('rowid');
      $.ajax({
           url:"<?php echo site_url('admin/belanjabarang/hapus_barang');?>",
           type:"POST",
           data:"rowid="+rowid
                +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
           cache:false,
           success:function(html){
              $("#show_daftar_belanja").html(html);
           }
      });
  })

  $(document).on("click",".btn_upd_new_qty",function(){
      var input_upd_qty=$('.modal_upd_qty #input_upd_qty').val();
      var rowid=$('.modal_upd_qty #rowid').val();
      $.ajax({
           url:"<?php echo site_url('admin/belanjabarang/update_qty');?>",
           type:"POST",
           data:"rowid="+rowid
                +"&qty="+input_upd_qty
                +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
           cache:false,
           success:function(html){
              $("#show_daftar_belanja").html(html);
              $(".modal_upd_qty").modal("hide");
              $(".modal-backdrop").remove();
           }
      });
  })

  $(document).on("click","#btn_hapus_semua_barang",function(){
      swal({
        title: 'Apakah anda Yakin Menghapus Data Dalam Daftar Belanja ?',
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
               url:"<?php echo site_url('admin/belanjabarang/hapus_semua_barang');?>",
               type:"POST",
               data:"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#show_daftar_belanja").html(html);
               }
          });
        }
      }); //End Of Swal
  })

  // Load Modal Cari Suplier
  $('.modal_upd_qty').on('show.bs.modal', function(e) {
    var rowid = $(e.relatedTarget).data('rowid');
    var qty = $(e.relatedTarget).data('qty');
    $('.modal_upd_qty #rowid').val(rowid);
    $('.modal_upd_qty #input_upd_qty').val(qty);
  });
  // End Of Load Modal Cari Suplier
</script>