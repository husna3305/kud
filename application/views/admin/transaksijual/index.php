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
      limit:17
    });
    $('.qtyformat').priceFormat({
      prefix: '',
      thousandsSeparator: '.',
      clearOnEmpty: true,
      centsLimit: 0,
      limit:7
    });
  var total_barang = parseInt(<?php echo $this->cart1->total_articles() ?>);
  if (total_barang==0) {
    $("#div_input_data_penjualan").addClass("disablediv");
  }else{
    $("#div_input_data_penjualan").removeClass("disablediv");
  }

  })
</script>
<style type="text/css">
  .disablediv{
    //pointer-events: none;
    //opacity: 0.4;
  }.hide{
    display: none;
  }.show{
    .display: block;
  }
</style>
<div id="content_transaksijual">
  <div class="content-wrapper">
  <section class="content-header">
    <?php echo $pagetitle; ?>
    <?php echo $breadcrumb; ?>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body">
            <form role="form">
              <!-- text input -->
              <div class="form-group">
                <label>Nama Barang</label>
                <div class="input-group">
                  <input type="text" class="form-control" readonly="" id="nama_barang">
                  <input type="hidden" name="id_stok" id="id_stok">
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
                <label>- Harga Satuan</label>
                <!--<label class="pull-right" style="font-size: 12px"><a href="#" id="btn_ganti_harga_jual_tunai">Ganti</a></label> -->
                <input type="text" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="harga_jual_tunai" id="harga_jual_tunai" readonly>
                <i id="harga_jual_tunai_error" style="display:none;color: red">Tentukan Harga Satuan Terlebih Dahulu</i>

              </div>

              <div class="form-group">
                <label>- Stok Tersedia</label>
                <!--<label class="pull-right" style="font-size: 12px"><a href="#" id="btn_ganti_harga_jual_tunai">Ganti</a></label> -->
                <input type="text" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="stok" id="stok_tampil" readonly>
                <input type="hidden" name="stok" id="stok">
              </div>

              <!--
              <div class="form-group">
                <label>- Harga Jual Angsuran</label>
                <label class="pull-right" style="font-size: 12px"><a href="#" id="btn_ganti_harga_jual_angsur">Ganti</a></label>
                <input type="text" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="harga_jual_angsur" id="harga_jual_angsur" readonly>
                <i id="harga_jual_angsur_error" st
yle="display:none;color: red">Tentukan Harga Jual Angsuran Terlebih Dahulu</i>

              </div> -->
              <input type="hidden" class="form-control input-group-sm priceformat" style="font-size: 20px;" name="harga_jual_angsur" id="harga_jual_angsur" readonly>
                </div>
                <!-- /.box-body -->
              </div>
               <div class="form-group">
                <label>Jumlah Barang</label>
                <input type="text" class="form-control input-group-sm qtyformat" style="font-size: 20px;" name="jml_belanja" id="jml_belanja">
                <i id="jml_belanja_error" style="display:none;color: red">Tentukan Jumlah Barang Terlebih Dahulu</i>

              </div>
              <div class="box-footer" align="center"><button name="btn_tambah_barang" type="button" class="btn btn-primary" id="btn_tambah_barang" value="val"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-warning"><i class="fa fa-undo-alt"></i>&nbsp;&nbsp;Reset</button></div>
            </form>
          </div>
      </div>
    </div>


    <div class="col-md-9">
      <div class="box box-primary disablediv" style="min-height: 559px" id="div_input_data_penjualan">
          <div class="box-body">
            <div id="show_daftar_transaksijual" style="border-bottom: 1px #cfcfcf solid;margin-bottom: 12px"></div>
            <div class="form-horizontal" >
              <div class="form-group">
                <label for="check_parent_id" class="col-sm-4 control-label" style="text-align:left">
                  <b style="text-align:right;">Jenis Pembayaran</b>                         
                </label>
                <div class="col-sm-8">
                 <input type="checkbox" checked data-toggle="toggle" data-on="Tunai / Cash" data-off="Angsuran" data-onstyle="success" data-offstyle="warning" data-width="130" data-height="33" id="check_jenispembayaran">
                </div>
              </div>
              <div class="form-group" id="div_jenisangsuran" style="display: none">
                <label for="check_parent_id" class="col-sm-4 control-label" style="text-align:left">
                  <b style="text-align:right;">Jenis Angsuran</b>                         
                </label>
                <div class="col-sm-8">
                 <input type="checkbox" checked data-toggle="toggle" data-on="Per Pembayaran" data-off="Per Barang" data-onstyle="success" data-offstyle="warning" data-width="130" data-height="33" id="check_jenisangsuran">
                </div>
              </div>

              <div class="form-group" id="div_penambahan_biaya_angsuran" style="display: none">
              <label for="link" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Penambahan Biaya Angsuran</b>                          
              </label>

              <div class="col-sm-5" >
                <input type="text" name="penambahan_biaya_angsuran_perpembayaran" class="form-control priceformat" id="penambahan_biaya_angsuran_perpembayaran" style="font-size: 20px;">
                <label class="control-label" id="penambahan_biaya_angsuran_perpembayaran_error" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan tentukan penambahan biaya angsuran</label>
              </div>
            </div>

            <div class="form-group" id="div_penyandangdana" style="display: none">
              <label for="link" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Pilih Penyandang Dana</b>                          
              </label>
              <div class="col-sm-6" >
                <input type="text" name="nama_penyandangdana" class="form-control" readonly id="nama_penyandangdana">
                <label id="penyandangdana_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan Pilih Data Penyandang Dana</label>
                <input type="hidden" name="id_penyandangdana" id="id_penyandangdana">
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cari-penyandangdana"><i class="fa fa-search"></i></button>
              </div>
            </div> 

            <div class="form-group" style="display: block">
              <label for="check_parent_id" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Pembeli</b>                         
              </label>
              <div class="col-sm-8">
               <input type="checkbox" checked data-toggle="toggle" data-on="Kelompok Tani" data-off="Konsumen Pribadi" data-onstyle="success" data-offstyle="warning" data-width="150" data-height="33" id="check_pembeli">
              </div>
            </div>  

            <div class="form-group" style="display: block">
              <label for="" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Insentif</b>                         
              </label>
              <div class="col-sm-8">
               <input type="checkbox" data-toggle="toggle" data-on="Ya" data-off="Tidak" data-onstyle="success" data-offstyle="warning" data-width="70" data-height="33" id="check_insentif">
              </div>
            </div>
            <div class="form-group" id="div_jenisinsentif" style="display: none">
              <label for="check_parent_id" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Jenis Insentif</b>                         
              </label>
              <div class="col-sm-8">
               <input type="checkbox" checked data-toggle="toggle" data-on="Per Pembayaran" data-off="Per Barang" data-onstyle="success" data-offstyle="warning" data-width="130" data-height="33" id="check_jenisinsentif">
              </div>
            </div>
            <div class="form-group" id="div_sumberinsentif" style="display: none">
              <label for="check_parent_id" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Sumber Insentif</b>                         
              </label>
              <div class="col-sm-8">
               <input type="checkbox" checked data-toggle="toggle" data-on="KUD" data-off="Penyandang Dana" data-onstyle="success" data-offstyle="warning" data-width="139" data-height="33" id="check_sumberinsentif">
              </div>
            </div>

            <div class="form-group" id="div_penambahan_insentif" style="display: none">
              <label for="link" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Jumlah Insentif</b>                          
              </label>

              <div class="col-sm-4" >
                <input type="text" name="penambahan_insentif" class="form-control priceformat" id="penambahan_insentif" style="font-size: 20px;">
                <label class="control-label" id="penambahan_insentif_error" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan tentukan penambahan insentif</label>
              </div>
            </div>    

            <div class="form-group" id="div_kelompoktani" style="display: block">
              <label for="link" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Pilih Kelompok Tani</b>                          
              </label>
              <div class="col-sm-6" >
                <input type="text" name="nama_kelompok_tani" class="form-control" readonly id="nama_kelompok_tani">
                <label id="kelompoktani_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan Pilih Data Kelompok Tani</label>
                <input type="hidden" name="id_kelompok_tani" id="id_kelompok_tani">
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cari-kelompoktani"><i class="fa fa-search"></i></button>
              </div>
            </div> 

            <div class="form-group" id="div_pribadi" style="display: none">
              <label for="link" class="col-sm-4 control-label" style="text-align:left">
                <b style="text-align:right;">Pilih Data Konsumen Pribadi</b>                          
              </label>
              <div class="col-sm-6" >
                <input type="text" name="nama_konsumenpribadi" class="form-control" readonly id="nama_konsumenpribadi">
                <label id="nama_konsumenpribadi_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan Pilih Data Konsumen Pribadi</label>
                <input type="hidden" name="id_konsumenpribadi" id="id_konsumenpribadi">
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_cari-konsumenpribadi"><i class="fa fa-search"></i></button>
              </div>
            </div> 


            <div class="form-group">
              <label for="link" class="col-sm-4 control-label" style="text-align:left">
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

<!-- Modal Cari Kelompok Tani -->
<div class="modal fade modal_cari-kelompoktani">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Data Kelompok Tani</h4>
      </div>
      <div class="modal-body" id="show_kelompoktani">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Kelompok Tani -->

<!-- Modal Cari Konsumen Pribadi -->
<div class="modal fade modal_cari-konsumenpribadi">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Data Konsumen Pribadi</h4>
      </div>
      <div class="modal-body" id="show_konsumenpribadi">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Konsumen Pribadi -->

<!-- Modal Cari Penyandang Dana -->
<div class="modal fade modal_cari-penyandangdana">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Data Penyandang Dana</h4>
      </div>
      <div class="modal-body" id="show_penyandangdana">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Penyandang Dana -->

</div>


<script type="text/javascript">
  $(document).ready(function(){
    $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');

  })

  // Cek Insentif
  $(function() {
    $('#check_insentif').change(function() {
      if ($('#check_insentif').is(":checked")) {
        div_sumberinsentif.style.display='block';
        div_jenisinsentif.style.display = 'block';
        $('#penambahan_insentif').val('');
        $('#check_jenisinsentif').bootstrapToggle('on');
        $('#check_sumberinsentif').bootstrapToggle('on');
        div_penambahan_insentif.style.display ='block';
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');
      }else{
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');
        div_jenisinsentif.style.display = 'none';
        div_penambahan_insentif.style.display ='none';
        div_sumberinsentif.style.display='none';        
      }
    })
    $('#check_jenisinsentif').change(function() {
      if ($('#check_jenisinsentif').is(":checked")) {
        $('#penambahan_insentif').val('');
        div_penambahan_insentif.style.display ='block';
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');
      }else{
        div_penambahan_insentif.style.display ='none';
        $('#penambahan_insentif').val('');
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');                
      }
    })
  })
  // End Of Cek Insentif

   // Cek Jenis Pembayaran
  $(function() {
    $('#check_jenispembayaran').change(function() {
      if ($('#check_jenispembayaran').is(":checked")) {
        $("#div_penyandangdana").addClass("hide");
        $("#div_penambahan_biaya_angsuran").addClass("hide");
        //div_penyandangdana.style.display = 'none';
        div_jenisangsuran.style.display = 'none';
        //div_penambahan_biaya_angsuran.style.display = 'none';
        $('#penambahan_biaya_angsuran_perpembayaran').val('');
        $('#check_jenisangsuran').bootstrapToggle('on');
        div_jenisangsuran.style.display = 'none';
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');                
      }else{
        $("#div_penyandangdana").removeClass("hide");
        $("#div_penambahan_biaya_angsuran").removeClass("hide");
        div_jenisangsuran.style.display = 'block';
        div_penambahan_biaya_angsuran.style.display = 'block';
        div_penyandangdana.style.display = 'block';
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');
      }
    })
  })
  // End Of Cek Jenis Pembayaran

  // Cek Jenis Angsuran
  $(function() {
    $('#check_jenisangsuran').change(function() {
      if ($('#check_jenisangsuran').is(":checked")) {
        div_penyandangdana.style.display = 'block';
        div_jenisangsuran.style.display = 'block';
        div_penambahan_biaya_angsuran.style.display = 'block';
        //show_penjualan.style.display = 'block';
        //show_penjualan.style.display = 'none';
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');                

       // total_angsuran_perpembayaran.style.display='contents';
      }else{
        div_jenisangsuran.style.display = 'block';
        div_penambahan_biaya_angsuran.style.display = 'none';
        div_penyandangdana.style.display = 'block';
        //show_penjualan.style.display = 'none';
        //show_penjualan.style.display = 'block';
        $("#show_daftar_transaksijual").load('<?php echo site_url('admin/transaksijual/tampilDaftarTransaksi') ?>');                

       // total_angsuran_perpembayaran.style.display='none';
      }
    })
  })
  // End Of Cek Jenis Angsuran

  $(function() {
    $('#check_pembeli').change(function() {
      if ($('#check_pembeli').is(":checked")) {
        div_pribadi.style.display = 'none';
        div_kelompoktani.style.display = 'block';
      }else{
        div_pribadi.style.display = 'block';
        div_kelompoktani.style.display = 'none';
      }
    })
  })
  // End Of Cek Jenis Pembayaran

  // Menghitung Penambahan Angsuran Per Pembayaran
  $('#penambahan_biaya_angsuran_perpembayaran').keyup(function() {
      var penambahan_biaya_angsuran = parseInt($('#penambahan_biaya_angsuran_perpembayaran').unmask());
      var total = parseInt($('#total_pembayaran').val());
      var hasil = 0;
      hasil = penambahan_biaya_angsuran + total;
      if (!penambahan_biaya_angsuran) {
        $('#hasil_penambahan_biaya_angsuran').text(total);
      }else{
        $('#hasil_penambahan_biaya_angsuran').text('Rp. '+hasil);
      }
  });
  // Menghitung Penambahan Angsuran Per Pembayaran

  // Cek Jumlah Barang Yang Dimaksukkan
  $('#jml_belanja').keyup(function() {
      var jml_belanja = parseInt($('#jml_belanja').unmask());
      var stok = parseInt($('#stok').val());
      if (jml_belanja > stok) {
        swal('Jumlah Barang Yang Dimaksukkan Melebihi Stok Yang Tersedia');
        $('#jml_belanja').val('');
      }
  });
  // Cek Jumlah Barang Yang Dimaksukkan
  
  // Load Modal Cari Kategori
  $('.modal_cari-barang').on('show.bs.modal', function(e) {
  $("#nama_barang").removeClass("has-input-error");nama_barang_error.style.display = 'none';
     var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     var  csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
             url:"<?php echo site_url('admin/transaksijual/search_barang');?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_barang").html(html);
             }
        });
  });
  // End Of Load Modal Cari Kategori

  // Load Modal Cari Kelompok Tani
  $('.modal_cari-kelompoktani').on('show.bs.modal', function(e) {
  $("#nama_kelompok_tani").removeClass("has-input-error");kelompoktani_error.style.display = 'none';
     var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     var  csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
             url:"<?php echo site_url('admin/transaksijual/search_kelompoktani');?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_kelompoktani").html(html);
             }
        });
  });
  // End Of Load Modal Cari Kelompok Tani

  // Load Modal Cari Penyandang Dana
  $('.modal_cari-penyandangdana').on('show.bs.modal', function(e) {
  $("#nama_penyandangdana").removeClass("has-input-error");penyandangdana_error.style.display = 'none';
     var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     var  csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
             url:"<?php echo site_url('admin/transaksijual/search_penyandangdana');?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_penyandangdana").html(html);
             }
        });
  });
  // End Of Load Modal Cari Penyandang Dana

 // Load Modal Cari Konsumen Pribadi
  $('.modal_cari-konsumenpribadi').on('show.bs.modal', function(e) {
  $("#nama_konsumenpribadi").removeClass("has-input-error");nama_konsumenpribadi_error.style.display = 'none';
     var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     var  csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
             url:"<?php echo site_url('admin/transaksijual/search_konsumenpribadi');?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_konsumenpribadi").html(html);
             }
        });
  });
  // End Of Load Modal Cari Konsumen Pribadi


  $('#btn_submit_data').click(function(){
      var nama_kelompok_tani  = $('#nama_kelompok_tani').val();    
      var nama_konsumenpribadi  = $('#nama_konsumenpribadi').val();    
      var tanggal       = $('.tanggal').val();
      var check_jenispembayaran       = $('#check_jenispembayaran').prop('checked');
      var check_pembeli       = $('#check_pembeli').prop('checked');
      var check_jenisangsuran       = $('#check_jenisangsuran').prop('checked');
      var id_konsumenpribadi       = $('#id_konsumenpribadi').val();
      var id_kelompok_tani        = $('#id_kelompok_tani').val();
      var id_penyandangdana        = $('#id_penyandangdana').val();
      var total_barang            = parseInt($('#total_barang').val());
      var penambahan_biaya_angsuran_perpembayaran = parseInt($('#penambahan_biaya_angsuran_perpembayaran').unmask());
      var status_pembeli = ''; 

      if (total_barang >0) {
        if ($('#check_pembeli').is(":checked")) {
          // Cek Input nama_kelompok_tani
          if (!id_kelompok_tani & !nama_kelompok_tani) {
              $("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_kelompok_tani").addClass("has-input-error");kelompoktani_error.style.display = 'block';
              status_pembeli='f';
            }else{
              $("#nama_kelompok_tani").removeClass("has-input-error");kelompoktani_error.style.display = 'none';
              status_pembeli='t';
          }
          //End Of Cek Input nama_kelompok_tani
      }else{
        // Cek Input nama_konsumenpribadi na
        if (!id_konsumenpribadi & !nama_konsumenpribadi) {
            $("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_konsumenpribadi").addClass("has-input-error");nama_konsumenpribadi_error.style.display = 'block';
            status_pembeli='f';
          }else{
            $("#nama_konsumenpribadi").removeClass("has-input-error");nama_konsumenpribadi_error.style.display = 'none';
            status_pembeli='t';
        }
        //End Of Cek Input nama_konsumenpribadi
      }

      // Cek Input tanggal
      if (!tanggal) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$(".tanggal").addClass("has-input-error");tanggal_error.style.display = 'block';
        }else{
          $(".tanggal").removeClass("has-input-error");tanggal_error.style.display = 'none';
      }
      //End Of Cek Input nama_suplier

      // Proses Simpan Daftar Transaksi Ke Database
      if (!!tanggal & status_pembeli=='t')
      {
        swal({
        title: 'Apakah anda Yakin Menyimpan Transaksi Ini ?',
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
               url:"<?php echo site_url('admin/transaksijual/simpanDaftarTransaksi');?>",
               type:"POST",
               data:"id_konsumenpribadi="+id_konsumenpribadi
                    +"&id_kelompok_tani="+id_kelompok_tani 
                    +"&id_penyandangdana="+id_penyandangdana 
                    +"&check_jenispembayaran="+check_jenispembayaran 
                    +"&check_pembeli="+check_pembeli 
                    +"&check_jenisangsuran="+check_jenisangsuran 
                    +"&penambahan_biaya_angsuran_perpembayaran="+penambahan_biaya_angsuran_perpembayaran 
                    +"&tanggal="+tanggal
                    +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#content_transaksijual").html(html);
               }
          });
        }
      }); //End Of Swal
      }
      // End Of Proses Simpan Daftar Transaksi Ke Database
    }else{
      swal('Data Barang Masih Kosong');
    }
  })

  // Tambah Barang Ke Daftar Transaksi
  //$('#btn_tambah_barang').click(function(){
  $(document).unbind('click').on("click", "#btn_tambah_barang", function () {
    $('#loading-status').show();
      var nama_barang       = $('#nama_barang').val();    
      var id_barang       = $('#id_barang').val();    
      var id_stok       = $('#id_stok').val();    
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

      // Cek Input harga_jual_tunai
      if (!harga_jual_tunai) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#harga_jual_tunai").addClass("has-input-error");harga_jual_tunai_error.style.display = 'block';
        }else{
          $("#harga_jual_tunai").removeClass("has-input-error");harga_jual_tunai_error.style.display = 'none';
      }
      //End Of Cek Input harga_jual_tunai
      // Cek Input jml_belanja
      if (!jml_belanja) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#jml_belanja").addClass("has-input-error");jml_belanja_error.style.display = 'block';
        }else{
          $("#jml_belanja").removeClass("has-input-error");jml_belanja_error.style.display = 'none';
      }
      //End Of Cek Input jml_belanja

      // Proses Tambah Barang Ke Daftar Transaksi
      if (!!nama_barang & !!harga_jual_angsur & !!harga_jual_tunai & !!jml_belanja)
      {
           $.ajax({
             url:"<?php echo site_url('admin/transaksijual/tambah_barang');?>",
             type:"POST",
             data:"nama_barang="+nama_barang
                  +"&id_barang="+id_barang 
                  +"&id_stok="+id_stok 
                  +"&harga_jual_angsur="+harga_jual_angsur 
                  +"&harga_jual_tunai="+harga_jual_tunai
                  +"&jml_belanja="+jml_belanja 
                  +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_daftar_transaksijual").html(html);
                $('#nama_barang').val('');
                $('#id_barang').val('');
                $('#harga_jual_angsur').val('');
                $('#harga_jual_tunai').val('');
                $('#jml_belanja').val('');
                $('#stok_tampil').val('');
                $("#div_input_data_penjualan").removeClass("disablediv");
                $('#loading-status').hide();
             }
        });
      }
      // End Of Proses Tambah Barang Ke Daftar Transaksi

  });
  // End OF Tambah Barang Ke Daftar Transaksi
  $(document).on("click","#btn_ganti_harga_jual_tunai",function(){
    event.preventDefault();
    $text = $("#btn_ganti_harga_jual_tunai").text();
      if ($text=='Ganti') {
        $("#harga_jual_tunai").removeAttr("readonly");
        $("#btn_ganti_harga_jual_tunai").text('Batal');
      }
      if ($text=='Batal') {
        $("#harga_jual_tunai").attr("readonly");
        $("#btn_ganti_harga_jual_tunai").text('Ganti');
      }
  })

  $(document).on("click",".btn_tambah_konsumenpribadi",function(){
    $("#show_konsumenpribadi").load('<?php echo site_url('admin/transaksijual/tambahKonsumenPribadi') ?>');
  })
  $(document).on("click",".btn_dataKonsumenPribadi",function(){
    $("#show_konsumenpribadi").load('<?php echo site_url('admin/transaksijual/search_konsumenpribadi') ?>');
  })
</script>