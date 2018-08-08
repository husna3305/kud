<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script type="text/javascript">
  $(document).ready(function(){
    $('.priceformat').priceFormat({
      prefix: '',
      thousandsSeparator: '.',
      clearOnEmpty: true,
      centsLimit: 0,
      limit:20
    });
    $('.qtyformat').priceFormat({
      prefix: '',
      thousandsSeparator: '.',
      clearOnEmpty: true,
      centsLimit: 0,
      limit:7
    });
  })
</script>
<div id="content_belanjabarang">
  <div class="content-wrapper">
  <section class="content-header">
    <?php echo $pagetitle; ?>
    <?php echo $breadcrumb; ?>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-body">
            <form role="form">
              <!-- text input -->
              <div class="form-group">
                <label>Nama Barang</label>
                <div class="input-group">
                  <input type="text" class="form-control" readonly="" id="nama_barang">
                  <input type="hidden" name="id_barang" id="id_barang">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target=".modal_cari-barang"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <div>
                  <i id="nama_barang_error" style="display: none;color: red">Silahkan pilih barang terlebih dahulu.</i>
                </div>
              </div>
              <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                <label>- Harga Beli Satuan</label>
                <input type="text" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="harga_beli" id="harga_beli">
                <i id="harga_beli_error" style="display:none;color: red">Tentukan Harga Beli Satuan Terlebih Dahulu</i>
              </div>
              <div class="form-group">
                <label>- Harga Jual Satuan</label>
                <input type="text" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="harga_jual_tunai" id="harga_jual_tunai">
                <i id="harga_jual_tunai_error" style="display:none;color: red">Tentukan Harga Jual Satuan Terlebih Dahulu</i>

              </div>
              <div class="form-group">
                <label>- Harga Jual Angsuran</label>
                <input type="text" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="harga_jual_angsur" id="harga_jual_angsur">
                <i id="harga_jual_angsur_error" style="display:none;color: red">Tentukan Harga Jual Angsuran Terlebih Dahulu</i>

              </div>
                </div>
                <!-- /.box-body -->
              </div>
               <div class="form-group">
                <label>Jumlah Belanja</label>
                <input type="text" class="form-control input-group-sm qtyformat" style="font-size: 20px;" name="jml_belanja" id="jml_belanja">
                <i id="jml_belanja_error" style="display:none;color: red">Tentukan Jumlah Belanja Terlebih Dahulu</i>

              </div>
              <div class="box-footer" align="center"><button name="btn_tambah_barang" type="button" class="btn btn-primary" id="btn_tambah_barang" value="val"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-warning"><i class="fa fa-undo-alt"></i>&nbsp;&nbsp;Reset</button></div>
            </form>
          </div>
      </div>
    </div>


    <div class="col-md-8">
      <div class="box box-primary" style="min-height: 559px">
          <div class="box-body">
            <div id="show_daftar_belanja"></div>
            <hr>
            <div class="form-horizontal">
                <div class="form-group">
              <label for="link" class="col-sm-3 control-label" style="text-align:left">
                <b style="text-align:right;">Pilih Suplier</b>                          
              </label>
              <div class="col-sm-6" >
                <input type="text" name="nama_suplier" class="form-control" readonly id="nama_suplier">
                <label id="nama_suplier_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan Pilih Data Suplier</label>
                <input type="hidden" name="id_suplier" id="id_suplier">
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cari-suplier"><i class="fa fa-search"></i></button>
              </div>
            </div>
            <div class="form-group">
              <label for="link" class="col-sm-3 control-label" style="text-align:left">
                <b style="text-align:right;">Tanggal Transaksi</b>                          
              </label>
              <div class="col-sm-5" >
                <input type="text" name="tanggal" class="form-control tanggal" readonly id="datepicker">
                <label class="control-label" id="tanggal_error" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan tentukan tanggal transaksi</label>
                <input type="hidden" name="id_kategori" id="id_kategori">
              </div>
            </div>
            </div>
          </div>
          <div class="box-footer" align="center"><button name="btn_submit_data" type="button" class="btn btn-primary btn-lg" id="btn_submit_data" value="val"><i class="fa fa-plus"></i>&nbsp;&nbsp;Simpan Data</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-undo-alt"></i>&nbsp;&nbsp;Batal</button></div>
      </div>
    </div>
  </section>
</div>


<!-- Modal Cari Barang -->
<div class="modal fade modal_cari-barang">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Data Barang</h4>
      </div>
      <div class="modal-body" id="show_barang">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Barang -->
<!-- Modal Cari Barang -->
<div class="modal fade modal_cari-suplier">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Data Suplier</h4>
      </div>
      <div class="modal-body" id="show_suplier">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Barang -->
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $("#show_daftar_belanja").load('<?php echo site_url('admin/belanjabarang/tampilDaftarBelanja') ?>');
  })
  // Load Modal Cari Kategori
  $('.modal_cari-barang').on('show.bs.modal', function(e) {
  $("#nama_barang").removeClass("has-input-error");nama_barang_error.style.display = 'none';
     var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     var  csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
             url:"<?php echo site_url('admin/belanjabarang/search_barang');?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_barang").html(html);
             }
        });
  });
  // End Of Load Modal Cari Kategori

  // Load Modal Cari Suplier
  $('.modal_cari-suplier').on('show.bs.modal', function(e) {
  $("#nama_suplier").removeClass("has-input-error");nama_suplier_error.style.display = 'none';
     var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     var  csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
             url:"<?php echo site_url('admin/belanjabarang/search_suplier');?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_suplier").html(html);
             }
        });
  });
  // End Of Load Modal Cari Suplier
  $('#btn_submit_data').click(function(){
      var nama_suplier  = $('#nama_suplier').val();    
      var id_suplier  = $('#id_suplier').val();    
      var tanggal       = $('.tanggal').val();
      var total_barang  = parseInt($('#total_barang').val()); 

      if (total_barang >0) {
        // Cek Input nama_suplier
      if (!nama_suplier & !id_suplier) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_suplier").addClass("has-input-error");nama_suplier_error.style.display = 'block';
        }else{
          $("#nama_suplier").removeClass("has-input-error");nama_suplier_error.style.display = 'none';
      }
      //End Of Cek Input nama_suplier

      // Cek Input tanggal
      if (!tanggal) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$(".tanggal").addClass("has-input-error");tanggal_error.style.display = 'block';
        }else{
          $(".tanggal").removeClass("has-input-error");tanggal_error.style.display = 'none';
      }
      //End Of Cek Input nama_suplier

      // Proses Simpan Daftar Belanja Ke Database
      if (!!nama_suplier & !!id_suplier & !!tanggal)
      {
        swal({
        title: 'Apakah anda Yakin Menyimpan Transaksi Belanja Ini ?',
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
               url:"<?php echo site_url('admin/belanjabarang/simpanDaftarBelanja');?>",
               type:"POST",
               data:"nama_suplier="+nama_suplier
                    +"&id_suplier="+id_suplier 
                    +"&tanggal="+tanggal
                    +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#content_belanjabarang").html(html);
               }
          });
        }
      }); //End Of Swal
      }
      // End Of Proses Simpan Daftar Belanja Ke Database
    }else{
      swal('Data Barang Masih Kosong');
    }
  })

  // Tambah Barang Ke Daftar Belanja
  $('#btn_tambah_barang').click(function(){
      var nama_barang       = $('#nama_barang').val();    
      var id_barang       = $('#id_barang').val();    
      var harga_beli        = parseInt($('#harga_beli').unmask());
      var harga_jual_tunai  = parseInt($('#harga_jual_tunai').unmask());
      var harga_jual_angsur = parseInt($('#harga_jual_angsur').unmask());
      var jml_belanja       = parseInt($('#jml_belanja').unmask());

      // Cek Input nama_barang
      if (!nama_barang & !id_barang) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_barang").addClass("has-input-error");nama_barang_error.style.display = 'block';
        }else{
          $("#nama_barang").removeClass("has-input-error");nama_barang_error.style.display = 'none';
      }
      //End Of Cek Input nama_barang

      // Cek Input harga_beli
      if (!harga_beli) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#harga_beli").addClass("has-input-error");harga_beli_error.style.display = 'block';
        }else{
          $("#harga_beli").removeClass("has-input-error");harga_beli_error.style.display = 'none';
      }
      //End Of Cek Input harga_beli
      // Cek Input harga_jual_tunai
      if (!harga_jual_tunai) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#harga_jual_tunai").addClass("has-input-error");harga_jual_tunai_error.style.display = 'block';
        }else{
          $("#harga_jual_tunai").removeClass("has-input-error");harga_jual_tunai_error.style.display = 'none';
      }
      //End Of Cek Input harga_jual_tunai
      // Cek Input harga_jual_angsur
      if (!harga_jual_angsur) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#harga_jual_angsur").addClass("has-input-error");harga_jual_angsur_error.style.display = 'block';
        }else{
          $("#harga_jual_angsur").removeClass("has-input-error");harga_jual_angsur_error.style.display = 'none';
      }
      //End Of Cek Input harga_jual_angsur
      // Cek Input jml_belanja
      if (!jml_belanja) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#jml_belanja").addClass("has-input-error");jml_belanja_error.style.display = 'block';
        }else{
          $("#jml_belanja").removeClass("has-input-error");jml_belanja_error.style.display = 'none';
      }
      //End Of Cek Input jml_belanja

      // Proses Tambah Barang Ke Daftar Belanja
      if (!!nama_barang & !!harga_beli & !!harga_jual_angsur & !!harga_jual_tunai & !!jml_belanja)
      {
           $.ajax({
             url:"<?php echo site_url('admin/belanjabarang/tambah_barang');?>",
             type:"POST",
             data:"nama_barang="+nama_barang
                  +"&id_barang="+id_barang 
                  +"&harga_beli="+harga_beli 
                  +"&harga_jual_angsur="+harga_jual_angsur 
                  +"&harga_jual_tunai="+harga_jual_tunai
                  +"&jml_belanja="+jml_belanja 
                  +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_daftar_belanja").html(html);
                $('#nama_barang').val('');
                $('#id_barang').val('');
                $('#harga_beli').val('');
                $('#harga_jual_angsur').val('');
                $('#harga_jual_tunai').val('');
                $('#jml_belanja').val('');
             }
        });
      }
      // End Of Proses Tambah Barang Ke Daftar Belanja

  });
  // End OF Tambah Barang Ke Daftar Belanja

</script>