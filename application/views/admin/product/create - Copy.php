<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script>
  $(function() {
    // Options textarea for description
    $('#description').froalaEditor({
      // Set maximum number of characters.
      charCounterMax: 2000,
      height: 200,
      toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline','formatOL','formatUL','outdent', 'indent', 'clearFormatting'],
      toolbarButtonsXS: ['undo', 'redo' , '-', 'bold', 'italic', 'underline'],
      theme: 'royal',
      quickInsertTags: [''],
      placeholderText: 'Isi deskripsi produk'
    });
    // Options input for Price Mask
    $('.priceformat').priceFormat({
      prefix: '',
      thousandsSeparator: '.',
      clearOnEmpty: true,
      centsLimit: 0,
      limit:9
    });
    $('.qty_format').priceFormat({
      prefix: '',
      thousandsSeparator: '.',
      clearOnEmpty: true,
      centsLimit: 0,
      limit:5
    });
    $('.b_plt_format').priceFormat({
      prefix: '',
      thousandsSeparator: '.',
      clearOnEmpty: true,
      centsLimit: 0,
      limit:5
    });
  });

</script>
			<div class="content-wrapper">
				<section class="content-header">
					<?php echo $pagetitle; ?>
					<?php echo $breadcrumb; ?>
				</section>

				<section class="content">
					<div class="row">
						<div class="col-md-12">
              <div class="form-horizontal">


<!-- ============================= Informasi Produk ========================= !-->
               <div class="box">
								<div class="box-header with-border">
									<h3 class="box-title"><b>Informasi Produk</b></h3>
								</div>
								<div class="box-body" style="padding-left:30px;">

                    <div class="form-group " >
											<label for="name" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Nama Produk</b> <br />
												<i style="font-size:12px;">Tulis nama produk baru</i>
											</label>
											<div class="col-sm-8">
                        <style media="screen">
                          .has-input-error{
                            border-color: #a94442;
                          }
                        </style>
												<input type="text" name="name" value="" id="name" class="form-control input-char-count" maxlength="80"/>
                        <label id="name_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Field ini harus diisi</label>
											</div>
										</div>
                    <div class="form-group">
											<label for="" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Upload Gambar</b> <br />
												<i style="font-size:12px;">Upload gambar untuk produk.(Format file JPG, JPEG, PNG, dan BMP. Maksimal 5 MB)</i>
											</label>
											<div class="col-sm-9">
                        <div class="form-group">
                          <?php $this->load->view('admin/product/img_product') ?>
                		  </div>
											</div>
										</div>
										<div class="form-group">
											<label for="description" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Deskripsi Produk Baru</b> <br />
												<i style="font-size:12px;">Tulis Deskripsi Produk Baru</i>
											</label>
											<div class="col-sm-8" >
												<textarea name="description" id="description" placeholder="Deskripsi" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo set_value('description') ?></textarea>
                        <label id="description_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Field ini harus diisi</label>
											</div>
										</div>
                    <div class="form-group">
											<label for="category" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Pilih Kategori</b> <br />
												<i style="font-size:12px;">Pilih kategori untuk menentukan kategori dari produk</i>
											</label>
											<div class="col-sm-4 " >
												<select name="category_id[]" id="category_id_1"class="form-control" style="margin-bottom:5px;">
													<option value="" selected="selected">--Pilih Kategori--</option>
													<?php foreach( $category_list as $cl ) { ?>
                              <option value="<?php echo $cl->category_id ?>"><?php echo $cl->name ?></option>
														<?php  } ?>
												</select>
                        <select class="form-control" name="category_id[]" style="display:none;margin-bottom:5px;" id="dropdown_subcategory"></select>
                        <select class="form-control" name="category_id[]" style="display:none" id="dropdown_subscategory"></select>
                        <label id="category_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan pilih kategori</label>
											</div>
										</div>
                    <div class="form-group">
											<label for="condition" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Pilih Kondisi Produk</b> <br />
												<i style="font-size:12px;">Pilih Kondisi Produk</i>
											</label>
											<div class="col-sm-4 " >
												<select name="condition_id" id="condition_id"class="form-control">
													<option value="" selected="selected">--Pilih Kondisi Produk--</option>
													<?php foreach( $condition_list as $cond_l ) { ?>
                              <option value="<?php echo $cond_l->condition_id ?>"><?php echo $cond_l->name ?></option>
														<?php  } ?>
												</select>
                        <label id="condition_id_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan pilih kondisi produk</label>
											</div>
										</div>
                    <div class="form-group">
											<label for="brand" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Pilih Brand</b> <br />
												<i style="font-size:12px;">Pilih brand untuk produk yang akan ditambah</i>
											</label>
											<div class="col-sm-4 " >
												<select name="brand_id" id="brand_id"class="form-control">
													<option value="" selected="selected">--Pilih Brand--</option>
													<?php foreach( $brand_list as $bd_l ) { ?>
                              <option value="<?php echo $bd_l->brand_id ?>"><?php echo $bd_l->name ?></option>
														<?php  } ?>
												</select>
                        <label id="brand_id_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan pilih brand produk</label>
											</div>
										</div>
                    <div class="form-group">
											<label for="category" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Video Produk</b> <br />
												<i style="font-size:12px;">Tambahkan URL Video untuk produk yang akan ditambah</i>
											</label>
											<div class="col-sm-7" >
												<input type="text" name="video" value="" class="form-control" id="video">
											</div>
										</div>

								</div>
							</div>
<!-- ============================= End of Informasi Produk ========================= !-->

<!-- ============================= Manajemen Produk ========================= !-->
              <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title"><b>Manajemen Produk</b></h3>
               </div>
               <div class="box-body" style="padding-left:30px;">
                   <div class="form-group">
                     <label for="order" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Pemesananan Minimum Produk</b> <br />
                       <i style="font-size:12px;">Tentukan pemesanan minimum untuk produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-2">
                       <input type="text" name="min_quantity_order" value="<?php echo set_value('min_quantity_order') ?>" id="min_quantity_order" class="form-control qty_format"/>
                       <label id="min_quantity_order_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan tentukan pemesanan minimum</label>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="quantity" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Jumlah Stok</b> <br />
                       <i style="font-size:12px;">Stok akan berkurang saat pembayaran produk oleh pembeli setelah dilakukan verifikasi</i>
                     </label>
                     <div class="col-sm-2">
                       <input type="text" name="quantity" value="<?php echo set_value('quantity') ?>" id="quantity" class="form-control qty_format"/>
                       <label id="quantity_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan tentukan Jumlah Stok</label>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="sku" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">SKU (Stock Keeping Unit)</b> <br />
                       <i style="font-size:12px;">Tulis SKU untuk menambahkan kode unik pada produk ini</i>
                     </label>
                     <div class="col-sm-3">
                       <input type="text" name="sku" value="<?php echo set_value('sku') ?>" id="sku" class="form-control"/>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Variasi Produk</b> <br />
                       <i style="font-size:12px;">Pilih variasi produk untuk menambahkan detail lebih lengkap dari produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-7">
                       <table class="" style="width:100%; margin-bottom:10px">
                         <tr id="variation_add"> </tr>
                       </table>
                       <button type="button" id="btn-variation-insert" name="button" class="btn btn-flat btn-primary">Tambah Variasi Produk</button>
                     </div>
                   </div>
               </div>
             </div>
<!-- ============================= End Of Manajemen Produk ========================= !-->
<!-- ============================= Harga Produk ========================= !-->
              <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title"><b>Harga Produk</b></h3>
               </div>
               <div class="box-body" style="padding-left:30px;">
                   <div class="form-group">
                     <label for="price" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Harga Produk</b> <br />
                       <i style="font-size:12px;">Tentukan harga untuk produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-2">
                       <select class="form-control" name="currency_id" id="currency_id">
                         <?php foreach ($curr_list as $cl): ?>
                            <option value="<?php echo $cl->currency_id ?>"><?php echo $cl->symbol ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                     <div class="col-sm-3">
                       <input type="text" name="price" value="" id="price" min="100" max="100000000" class="form-control priceformat"/>
                       <label id="price_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan tentukan harga</label>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="order" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Harga Grosir</b> <br />
                       <i style="font-size:12px;">Klik tombol Tambah Harga Grosir untuk menambahkan harga grosir dari produk dari produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-7">
                       <input type="checkbox" onchange="do_show_btn_wholesale(this)" id="checked_btn_wholesale_insert" name="active" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak"> <br><br>
                       <div style="display:none" id="wholesale_column">
                           <table class="" style="width:100%; margin-bottom:10px">
                             <tr>
                               <td>Min.</td><td>Max.</td><td>Harga</td><td></td>
                             </tr>
                             <tbody id="wholesale_add"> </tbody>
                           </table>
                           <button type="button" id="btn-wholesale-insert" name="button" class="btn btn-flat btn-primary">Tambah Harga Grosir</button> <br>
                       </div>
                     </div>
                   </div>
               </div>
             </div>
<!-- ============================= End Of Harga Produk ========================= !-->

<!-- ============================= Pengiriman Produk ========================= !-->
              <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title"><b>Pengiriman Produk</b></h3>
               </div>
               <div class="box-body" style="padding-left:30px;">
                   <div class="form-group">
                     <label for="order" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Berat Produk</b> <br />
                       <i style="font-size:12px;">Tentukan berat produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-2">
                       <select class="form-control" name="weight_measurement" id="weight_measurement">
                          <option value="g">Gram (g)</option>
                          <option value="kg">Kilogram (Kg)</option>
                        </select>
                     </div>
                     <div class="col-sm-2">
                        <input placeholder="Masukkan Berat" type="text" name="weight" value="" id="weight" class="form-control b_plt_format"/>
                        <label id="weight_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan masukkan berat</label>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="order" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Panjang Produk</b> <br />
                       <i style="font-size:12px;">Tentukan panjang produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-2">
                       <select class="form-control" name="length_measurement" id="length_measurement">
                          <option value="g">Centimeter (CM)</option>
                          <option value="kg">Meter (M)</option>
                        </select>
                     </div>
                     <div class="col-sm-2">
                        <input placeholder="Masukkan Panjang" type="text" name="length" value="<?php echo set_value('length') ?>" id="length" class="form-control b_plt_format"/>
                        <label id="length_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan masukkan panjang</label>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="order" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Lebar Produk</b> <br />
                       <i style="font-size:12px;">Tentukan lebar produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-2">
                       <select class="form-control" name="width_measurement" id="width_measurement">
                          <option value="g">Centimeter (CM)</option>
                          <option value="kg">Meter (M)</option>
                        </select>
                     </div>
                     <div class="col-sm-2">
                        <input placeholder="Masukkan Lebar" type="text" name="width" value="<?php echo set_value('width') ?>" id="width" class="form-control b_plt_format"/>
                        <label id="width_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan masukkan lebar</label>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="order" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Tinggi Produk</b> <br />
                       <i style="font-size:12px;">Tentukan tinggi produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-2">
                       <select class="form-control" name="height_measurement" id="height_measurement">
                          <option value="g">Centimeter (CM)</option>
                          <option value="kg">Meter (M)</option>
                        </select>
                     </div>
                     <div class="col-sm-2">
                        <input placeholder="Masukkan Tinggi" type="text" name="height" value="<?php echo set_value('height') ?>" id="height" class="form-control b_plt_format"/>
                        <label id="height_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan masukkan tinggi</label>
                     </div>
                   </div>
                   <div class="form-group">
                      <label for="insurance" class="col-sm-3 control-label" style="text-align:left">
                        <b style="text-align:right;">Asuransi</b> <br />
                        <i style="font-size:12px;">Aktifkan jaminan kerugian, kerusakan & kehilangan atas pengiriman produk ini</i>
                      </label>
                      <div class="col-sm-9">
                        <input type="checkbox" id="insurance" name="insurance" data-toggle="toggle" data-width="90" data-height="33" data-on="Ya" data-off="Opsional">
                      </div>
                    </div>
               </div>
             </div>
<!-- ============================= End Of Harga Produk ========================= !-->

<!-- ============================= Diskon Produk =========================
              <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title"><b>Diskon Produk</b></h3>
               </div>
               <div class="box-body" style="padding-left:30px;">
                   <div class="form-group">
                     <label for="min_qty_discount" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Minimum Pembelian</b> <br />
                       <i style="font-size:12px;">Tentukan minimum pembelian untuk mendapatkan diskon pada produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-2">
                       <input type="text" name="min_qty_discount" value="" id="min_qty_discount" class="form-control qty_format"/>
                     </div>
                   </div>

                   <div class="form-group">
                     <label for="discount_type" class="col-sm-3 control-label" style="text-align:left">
                       <b style="text-align:right;">Jenis Diskon</b> <br />
                       <i style="font-size:12px;">Tentukan jenis potongan untuk produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-3">
                       <select class="form-control" name="discount_type" id="discount_type" style="margin-bottom:5px;">
                         <option value="" selected>-- Pilih Jenis Diskon --</option>
                         <option value="persen">Persen (%)</option>
                         <option value="rupiah">Rupiah (Rp.)</option>
                       </select>
                       <input type="text" style="display:none" id="discount_value" name="discount_value" value="" id="discount_value" placeholder="Nilai Diskon" class="form-control priceformat"/>
                     </div>
                   </div>
               </div>
             </div>
<!-- ============================= End Of Diskon Produk ========================= !-->

<!-- ============================= Kombinasi Dari Produk Lama========================= !-->
              <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title"><b>Kombinasi Produk Dengan Produk Lama</b></h3>
               </div>
               <div class="box-body" style="padding-left:30px;">
                 <div class="form-group">

                   <label for="order" class="col-sm-3 control-label" style="text-align:left">
                     <b style="text-align:right;">Kombinasi Produk</b> <br />
                     <i style="font-size:12px;">Klik tombol Tambah Kombinasi Produk untuk menambahkan kombinasi produk dengan produk lama</i>
                   </label>
                   <div class="col-sm-7">
                     <div class="col-sm-12">
                       <input type="text" name="name" value="" id="xx" class="xx form-control qty_format input-char-count" maxlength="80"/>
                     </div>
                     <div class="col-sm-12">
                       <input type="text" name="name" value="" id="xx" class="xx form-control input-char-count" maxlength="70"/>

                         <table class="" style="width:100%; margin-bottom:10px">
                           <tbody id="combine_add"> </tbody>
                         </table>
                     <button type="button" id="btn-combine-insert" name="button" class="btn btn-flat btn-primary">Tambah Kombinasi Produk</button> <br>
                   </div>

                 </div>
                 <div class="form-group">

                 </div>
               </div>
             </div>
<!-- ============================= End Of Kombinasi Dari Produk Lama ========================= !-->

						 </div>
             <div class="form-group">
               <div class="col-sm-offset-4 col-sm-8">
                 <div class="btn-group">
                   <style media="screen">
                     .space8{
                       margin-right: 8px
                     }
                   </style>
                   <button type="button" class="btn btn-primary btn-lg btn-flat" id="btn_submitproduct" name="submit_product" style="margin-right:8px">Submit</button>
                   <?php //echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                   <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-lg btn-flat space8', 'content' => lang('actions_reset'))); ?>
                   <?php echo anchor('admin/product', lang('actions_cancel'), array('class' => 'btn btn-lg btn-default btn-flat')); ?>
                 </div>
               </div>

             </div>
           </div>
					</div>
				</section>
			</div>


<script type="text/javascript">
function do_show_btn_wholesale(checkboxElem) {
    var wholesale_column = document.getElementById("wholesale_column");
  if (checkboxElem.checked) {
      wholesale_column.style.display = 'block'
  } else {
    wholesale_column.style.display = 'none';
    $('.records_wholesale').remove();
  }
}

</script>

<script type="text/javascript">

  $(document).ready(function(){
    var count_variation = 1;
    var check_count_variation = 1;
    var count_wholesale = 1;
    var check_count_wholesale = 1;
    var count_combine = 1;
    var check_count_combine = 1;
    var check_show_combine = 0;
    var x = $('#price').val();
    var new_text = x.replace(".", "");
//$('#price').jStepper({minValue:2, maxValue:23, minLength:2});
//new_text.jStepper({minValue:1, maxValue:100});
  //===================================== Information Of Product =====================
  $('#category_id_1').change(function() {

    //  var val = $("#category_id_1 option:selected").text();
      var category_id = $(category_id_1).val();

      $("#dropdown_subcategory").html('');
      $("#dropdown_subcategory").append('<option value="">Pilih</option>');
      $("#dropdown_subscategory").html('');
      $("#dropdown_subscategory").append('<option value="">Pilih</option>');
      dropdown_subscategory.style.display = 'none';
      dropdown_subcategory.style.display = 'none';
      $.ajax({
          url:"<?php echo site_url('admin/product/ajaxSelectSubCategory');?>",
          type:"POST",
          data:"category_id="+category_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
          //data: {csrfName : csrfHash,"menu_id" : menu_id, "group_id" :group_id},
          dataType : 'json',
          cache:false,
          success:function(result){
                for(var i = 0; i < result.length; i++){
                  $("#dropdown_subcategory").append('<option value="'+ result[i].category_id+'">' + result[i].name + '</option>');
                }
                dropdown_subcategory.style.display = 'block';
              }
      })
    });

    $('#dropdown_subcategory').change(function() {

      //  var val = $("#category_id_1 option:selected").text();
      var category_id = $(dropdown_subcategory).val();
      var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
      var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      $("#dropdown_subscategory").html('');
      $("#dropdown_subscategory").append('<option value="">Pilih</option>');
      dropdown_subscategory.style.display = 'none';
      $.ajax({
          url:"<?php echo site_url('admin/product/ajaxSelectSubsCategory');?>",
          type:"POST",
          data:"category_id="+category_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
          //data: {csrfName : csrfHash,"menu_id" : menu_id, "group_id" :group_id},
          dataType : 'json',
          cache:false,
          success:function(result){
                for(var i = 0; i < result.length; i++){
                  $("#dropdown_subscategory").append('<option value="'+ result[i].category_id+'">' + result[i].name + '</option>');
                }
                dropdown_subscategory.style.display = 'block';
              }
      })
    });
  //===================================== Manajemen =====================
    $('#btn-variation-insert').click(function(){
			$("#variation_add").append('<tr class="records">'
        +'<td style="width:50%"><select style="width:95%;margin-bottom:5px;" name="variation_id_'+count_variation+'" id="variation_id_'+count_variation+'" class="form-control">'
        +'<option value="" selected>--Pilih Variasi Produk</option>'
        +'<?php foreach ($variation_list as $vs) { ?>'
        +'<option value="<?php echo $vs->variation_id?>"><?php echo $vs->name ?></option>'
        +'<?php } ?>'
        +'</select></td>'
        +'<td style="width:50%"><input class="form-control" style="width:95%;margin-bottom:5px;" type="text" name="value_'+count_variation+'" id="value_'+count_variation+'" /></td>'
        +'<td><button type="button" class="remove_item btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button> </br> </td>'
        +'</tr>'
      );
      check_count_variation = check_count_variation +1;
			count_variation = count_variation +1;
    })

    // Hapus Satu Form Inputan Variasi
		$(document).on("click",".remove_item",function(ev){
			if (ev.type == 'click') {
				check_count_variation = check_count_variation - 1;
				$(this).parents(".records").remove();
			}
		});
    //===================================== End Of Manajemen =====================
    $('#discount_type').change(function() {
      if (!$('#discount_type').val()) {
          discount_value.style.display = 'none';
      }else{
        discount_value.style.display = 'block';
      }

    });

    $('.xx').keyup(function() {
    alert('fewf');// get the current value of the input field.
});
    //===================================== Grosir =====================

    $('#btn-wholesale-insert').click(function(){

			$("#wholesale_add").append('<tr class="records_wholesale">'
        +'<td style="width:25%"><input class="form-control" style="width:70%;margin-bottom:5px;" type="text" name="min_qty_wholesale_'+count_wholesale+'" id="min_qty_wholesale_'+count_wholesale+'" /></td>'
        +'<td style="width:25%"><input class="form-control" style="width:70%;margin-bottom:5px;" type="text" name="max_qty_wholesale_'+count_wholesale+'" id="max_qty_wholesale_'+count_wholesale+'" /></td>'
        +'<td style="width:50%"><input class="form-control" style="width:70%;margin-bottom:5px;" type="text" name="price_wholesale_'+count_wholesale+'" id="price_wholesale_'+count_wholesale+'" /></td>'
        +'<td><button type="button" class="remove_item_wholesale btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button> </br> </td>'
        +'</tr>'
      );
      check_count_wholesale = check_count_wholesale +1;
			count_wholesale = count_wholesale +1;
    })
    // Hapus Satu Form Inputan Grosir
		$(document).on("click",".remove_item_wholesale",function(ev){
			if (ev.type == 'click') {
				check_count_wholesale = check_count_wholesale - 1;
				$(this).parents(".records_wholesale").remove();
			}
		});
    //===================================== End Of Grosir =======================

    //===================================== Kombinasi Produk =====================

  /*  $('#btn-combine-insert').click(function(){
      check_show_combine = check_show_combine +1;
		var str=('<tr class="records_combine">'
        +'<td style="width:10%"><button type="button" class="btn btn-sm btn-default" data-count_search="'+count_combine+'" data-toggle="modal" data-target=".modal-search-product">Cari <i class="fa fa-search"></i></button></td>'
        +'<td style="width:30%;"><input type="hidden" name="product_id_'+count_combine+'" id="product_id_'+count_combine+'" /><input class="form-control priceformat" style="width:95%" type="text" name="name_'+count_combine+'" placeholder="Nama Produk" id="name_'+count_combine+'" disabled/>'
        +'<input class="form-control" style="width:95%" type="text" placeholder="Harga Produk" name="price_'+count_combine+'" id="price_'+count_combine+'" disabled/><br></td>'
        +'<td style="width:40%">Harga Kombinasi Dengan Produk Lama</td>'
        +'<td style="width:20%"><input class="form-control input-char-count priceformat"  maxlength="80" style="width:95%" type="text" name="price_combine_'+count_combine+'" id="price_combine_'+count_combine+'"/>'
        +'<td><button type="button" class="remove_item_combine btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button> </br> </td>'
        +'</tr>');
        document.getElementById( 'combine_add' ).insertAdjacentHTML( 'beforeend', str );*/
      //  .appendTo("#combine_add");
      $('#btn-combine-insert').click(function(){
        check_show_combine = check_show_combine +1;
  			$("#combine_add").append('<tr class="records_combine">'
          +'<td style="width:10%"><button type="button" class="btn btn-sm btn-default" data-count_search="'+count_combine+'" data-toggle="modal" data-target=".modal-search-product">Cari <i class="fa fa-search"></i></button></td>'
          +'<td style="width:30%;"><input type="hidden" name="product_id_'+count_combine+'" id="product_id_'+count_combine+'" /><input class="form-control" style="width:95%" type="text" name="name_'+count_combine+'" placeholder="Nama Produk" id="name_'+count_combine+'" disabled/>'
          +'<input class="form-control" style="width:95%" type="text" placeholder="Harga Produk" name="price_'+count_combine+'" id="price_'+count_combine+'" disabled/><br></td>'
          +'<td style="width:40%">Harga Kombinasi Dengan Produk Lama</td>'
          +'<td style="width:20%"><input class="form-control xx" style="width:95%" type="text" name="price_combine_'+count_combine+'" id="price_combine_'+count_combine+'"/>'
          +'<td><button type="button" class="remove_item_combine btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button> </br> </td>'
          +'</tr>'
        );
      check_count_combine = check_count_combine +1;
			count_combine = count_combine +1;
    })
    // Hapus Satu Form Inputan
		$(document).on("click",".remove_item_combine",function(ev){
			if (ev.type == 'click') {
				check_count_combine = check_count_combine - 1;
        check_show_combine = check_show_combine -1;
				$(this).parents(".records_combine").remove();
			}
		});
    /* Modal Search Product */
    $('.modal-search-product').on('show.bs.modal', function(e) {
           var count_search = $(e.relatedTarget).data('count_search');
           $("#count_search").val(count_search);
           var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
           var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
           $.ajax({
               url:"<?php echo site_url('admin/product/ajaxSearchProduct');?>",
               type:"POST",
               data:"count_search="+count_search+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#show_search_product").html(html);
               }
          })
    });

    $(document).on("click",".combine_product_add",function(){
  		var count_search=$(this).attr("count_search");
  		var name=$(this).attr('name_'+count_search);
      var product_id=$(this).attr('product_id_'+count_search);
      var price=$(this).attr('price_'+count_search);

  		$('#name_'+count_search).val(name);
      $('#product_id_'+count_search).val(product_id);
      $('#price_'+count_search).val(price);
  		$(".modal-search-product").modal("hide");
		})
    /* End Modal Search Product */
    //===================================== End Of Kombinasi Produk =======================

    //===================================== Submit Process ================================

    $('#btn_submitproduct').click(function(){
        /* ----- Create Product ---------*/
        var name              = $('#name').val();
        var description       = $('#description').val();
        var condition_id      = $('#condition_id').val();
        var brand_id          = $('#brand_id').val();
        var sku               = $('#sku').val();
        var quantity          = $('#quantity').unmask();
        var low_stock_alert   = $('#low_stock_alert').val();
        var price             = $('#price').unmask();
        var min_quantity_order= $('#min_quantity_order').unmask();
        var weight            = $('#weight').unmask();
        var weight_measurement= $('#weight_measurement').val();
        var length            = $('#length').unmask();
        var width_measurement = $('#width_measurement').val();
        var height            = $('#height').unmask();
        var height_measurement= $('#height_measurement').val();
        var length_measurement= $('#length_measurement').val();
        var width             = $('#width').unmask();
        var min_qty_discount  = $('#min_qty_discount').unmask();
        var discount_type     = $('#discount_type').val();
        var discount_value    = $('#discount_value')  .unmask();
        var currency_id       = $('#currency_id')  .val();
        var category_id_1     = $('#category_id_1').val();
        var check_img_upload  = $('#check_img_upload').val();
        if ($('#insurance').is(":checked")) {
            var insurance = 1;
        } else {
            var insurance = 0;
        }
        if (!name) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#name").addClass("has-input-error");name_error.style.display = 'block';
        }else{
          $("#name").removeClass("has-input-error");name_error.style.display = 'none';
        }
        if (!description) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#description").addClass("has-input-error");description_error.style.display = 'block';
        }else{
          $("#description").removeClass("has-input-error");description_error.style.display = 'none';
        }
        if (!category_id_1) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#category_id_1").addClass("has-input-error");category_error.style.display = 'block';
        }else{
          $("#category_id_1").removeClass("has-input-error");category_error.style.display = 'none';
        }
        if (!condition_id) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#condition_id").addClass("has-input-error");condition_id_error.style.display = 'block';
        }else{
          $("#condition_id").removeClass("has-input-error");condition_id_error.style.display = 'none';
        }
        if (!brand_id) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#brand_id").addClass("has-input-error");brand_id_error.style.display = 'block';
        }else{
          $("#brand_id").removeClass("has-input-error");brand_id_error.style.display = 'none';
        }
        if (!min_quantity_order) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#min_quantity_order").addClass("has-input-error");min_quantity_order_error.style.display = 'block';
        }else{
          $("#min_quantity_order").removeClass("has-input-error");min_quantity_order_error.style.display = 'none';
        }
        if (!quantity) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#quantity").addClass("has-input-error");quantity_error.style.display = 'block';
        }else{
          $("#quantity").removeClass("has-input-error");quantity_error.style.display = 'none';
        }
        if (!price) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#price").addClass("has-input-error");price_error.style.display = 'block';
        }else{
          $("#price").removeClass("has-input-error");price_error.style.display = 'none';
        }
        if (!weight) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#weight").addClass("has-input-error");weight_error.style.display = 'block';
        }else{
          $("#weight").removeClass("has-input-error");weight_error.style.display = 'none';
        }
        if (!length) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#length").addClass("has-input-error");length_error.style.display = 'block';
        }else{
          $("#length").removeClass("has-input-error");length_error.style.display = 'none';
        }
        if (!width) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#width").addClass("has-input-error");width_error.style.display = 'block';
        }else{
          $("#width").removeClass("has-input-error");width_error.style.display = 'none';
        }
        if (!height) {
          $("html, body").animate({ scrollTop: 0 }, "fast");$("#height").addClass("has-input-error");height_error.style.display = 'block';
            //alert('def'+price);
        }else{
          $("#height").removeClass("has-input-error");height_error.style.display = 'none';
        }
        if (!$('#check_img_upload').val()) {
          $("html, body").animate({ scrollTop: 0 }, "fast");img_upload_error.style.display = 'block';
            //alert('def'+price);
        }else{
          img_upload_error.style.display = 'none';
        }
        if (!!name & !!description & !!category_id_1 & !!condition_id & !!brand_id & !!min_quantity_order & !!quantity & !!price & !!weight & !!length & !!width & !!height & !!check_img_upload) {
        $.ajax({
            url:"<?php echo site_url('admin/product/ajaxCreateProduct');?>",
            type:"POST",
            data:"name="+name
                +"&description="+description
                +"&condition_id="+condition_id
                +"&brand_id="+brand_id
                +"&sku="+sku
                +"&quantity="+quantity
                +"&low_stock_alert="+low_stock_alert
                +"&price="+price
                +"&min_quantity_order="+min_quantity_order
                +"&weight="+weight
                +"&weight_measurement="+weight_measurement
                +"&length="+length
                +"&width_measurement="+width_measurement
                +"&height="+height
                +"&height_measurement="+height_measurement
                +"&length_measurement="+length_measurement
                +"&width="+width
                +"&insurance="+insurance
                +"&min_qty_discount="+min_qty_discount
                +"&discount_type="+discount_type
                +"&discount_value="+discount_value
                +"&currency_id="+currency_id
                +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",

            cache:false,
            success:function(result){
              var max_product_id = result;
              /* ----- Create Category -------- */
              $('#max_product_id').val(max_product_id);
              if($('.start').click()){
              $("html, body").animate({ scrollTop: 0 }, "fast");
            }
              var category_id_1 = $('#category_id_1').val();
              var dropdown_subcategory = $('#dropdown_subcategory').val();
              var dropdown_subscategory = $('#dropdown_subscategory').val();
              $.ajax({
                  url:"<?php echo site_url('admin/product/ajaxCreateCategoryProduct');?>",
                  type:"POST",
                  data:"category_id_1="+category_id_1
                      +"&dropdown_subcategory="+dropdown_subcategory
                      +"&dropdown_subscategory="+dropdown_subscategory
                      +"&max_product_id="+max_product_id
                      +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
                  dataType : 'json',
                  cache:false,
                  success:function(result){
                  }
                })
                /* ----- End Of Create Category ----- */
                /* ----- Create Variation -------- */
                data_variation = new Array();
                for (var i = 1; i <= count_variation; i++) {
                  data_variation.push({
                    "value" : $('#value_'+i).val(),
                    "variation_id" : $('#variation_id_'+i).val(),
                    "max_product_id" : max_product_id
                  })
                }

                var jsonString = JSON.stringify(data_variation);

                $.ajax({
                    url:"<?php echo site_url('admin/product/ajaxCreateVariationProduct');?>",
                    type:"POST",
                    data:"data="+jsonString
                          +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
                    dataType : 'json',
                    cache:false,
                    success:function(result){
                    }
                  })
                   /*----- End Of Create Variation ----- */
                   /* ----- Create Wholesale -------- */
                 data_wholesale = new Array();
                 for (var i = 1; i <= count_wholesale; i++) {
                   data_wholesale.push({
                     "min_qty" : $('#min_qty_wholesale_'+i).val(),
                     "max_qty" : $('#max_qty_wholesale_'+i).val(),
                     "price_wholesale" : $('#price_wholesale_'+i).val(),
                   })
                 }
                 var jsonString = JSON.stringify(data_wholesale);
                 $.ajax({
                     url:"<?php echo site_url('admin/product/ajaxCreateWholesaleProduct');?>",
                     type:"POST",
                     data:"data="+jsonString
                           +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
                     dataType : 'json',
                     cache:false,
                     success:function(result){
                     }
                   })
                    /*----- End Of Create Wholesale ----- */
                    /* ----- Create Combine Product --------*/
                    if(check_show_combine > 0){
                      data_combine = new Array();
                      for (var i = 1; i <= count_combine; i++) {
                        data_combine.push({
                          "product_id" : $('#product_id_'+i).val(),
                          "price_combine" : $('#price_combine_'+i).val(),
                        })
                      }

                      var jsonString = JSON.stringify(data_combine);

                      $.ajax({
                          url:"<?php echo site_url('admin/product/ajaxCreateCombineProduct');?>",
                          type:"POST",
                          data:"data="+jsonString
                                +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
                          dataType : 'json',
                          cache:false,
                          success:function(result){
                          }
                        })
                    }
                     /*----- End Of Create Combine Product -----
                     var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
                     var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
                     var form_data = new FormData();
                     var file_data = $('#img_product').prop('files')[0];
                     //form_data.append("img_product", document.getElementById('img_product').files[0])
                     //form_data.append('img_product', $('input[id="img_product"]')[0].files[0]);
                     form_data.append('img_product', file_data);
                     //form_data.append('img_product', $('#img_product')[0].files[0]);
                     form_data.append("max_product_id", max_product_id);
                     form_data.append(csrfName, csrfHash);
$.ajax({
url:"<?php echo site_url('admin/product/ajaxImgUpload');?>",
method:"POST",
data: form_data,
contentType: false,
cache: false,
processData: false,
beforeSend:function(){
},
success:function(data)
{
alert('Upload Gambar Sukses')
}
});*/
            // window.location.href = '<?php echo base_url('admin/product'); ?>';
            }
          })
        }
        /* ----- End Create Product ----- */
		});

    //==================================== End Of Submit Process ==========================

  })
</script>

<div class="modal fade modal-search-product">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    	   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	   <span aria-hidden="true">&times;</span></button>
    	   <h4 class="modal-title">Default Modal</h4>
      </div>
      <div class="modal-body" id="show_search_product">
      </div>
      <div class="modal-footer">
    	   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
