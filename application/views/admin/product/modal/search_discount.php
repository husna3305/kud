<style media="screen">
	.has-input-error{
		border-color: #a94442;
	}
</style>
<table class="table" style="width:100%">
	<thead>
		<tr>
			<th>Gambar</th>
			<th>Nama Produk</th>
			<th>Harga</th>
		</tr>
	</thead>
	<tr>
		<td>
				<img src="<?php echo base_url('upload/product/'.$product->filename); ?>" class="img-responsive img-rounded" width="95px">
		</td>
		<td class="wrapword">
		<?php echo $product->name ?></td>
		<td>
			<span class="priceformat"><?php echo $product->price ?></span>
			<input type="hidden" value="<?php echo $product->price ?>" id="price"/>
				<?php
					$product_id = $this->encrypt->encode($product->product_id);
					$product_id = strtr($product_id,array('+' => '.', '=' => '-', '/' => '~')); ?>
				<input type="hidden" value="<?php echo $product_id ?>" id="product_id"/>
				<input type="hidden" value="<?php echo $product->currency_id ?>" id="currency_id"/><?php $symbol=$product->symbol ?>
		</td>
	</tr>

</table>
<!-- ============================= Diskon Produk ========================= !-->
<label id="label_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan lengkapi field yang berwarna merah</label>
<form class="form-horizontal" action="" method="post">
                   <div class="form-group">
                     <label for="min_qty_discount" class="col-sm-5 control-label" style="text-align:left">
                       <b style="text-align:right;">Minimum Pembelian</b> <br />
                       <i style="font-size:12px;">Tentukan minimum pembelian untuk mendapatkan diskon pada produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-4">
                       <input type="text" name="min_qty_discount" value="" id="min_qty_discount" class="form-control qty_format"/>
											 <label id="min_qty_discount_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Field ini harus di isi</label>
                     </div>
                   </div>

                   <div class="form-group">
                     <label for="discount_type" class="col-sm-5 control-label" style="text-align:left">
                       <b style="text-align:right;">Jenis Diskon</b> <br />
                       <i style="font-size:12px;">Tentukan jenis potongan untuk produk yang akan dibuat</i>
                     </label>
                     <div class="col-sm-5">
                       <select class="form-control" name="discount_type" id="discount_type" style="margin-bottom:5px;">
                         <option value="" selected>-- Pilih Jenis Diskon --</option>
                         <option value="persen">Persen (%)</option>
                         <option value="rupiah">Rupiah (Rp.)</option>
                       </select>
											 <label id="discount_type_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Silahkan pilih jenis diskon</label>
                       <input type="number" style="display:none"name="discount_value" value="" id="discount_value" placeholder="Nilai Diskon" class="form-control priceformatnopfx"/>
											 <label id="discount_value_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Field ini harus di isi</label>
                     </div>
									 </div>
									 <div class="form-group" id="input_price_afterdiscount"  style="display:none" >
                     <label for="discount_type" class="col-sm-5 control-label" style="text-align:left">
                       <b style="text-align:right;">Harga Setelah Diskon</b> <br />
                       <i style="font-size:12px;">Harga yang digunakan setelah diberikan diskon pada produk yang dipilih</i>
                     </label>
                     <div class="col-sm-5">
											 <input type="number" name="price_afterdiscount" value="" id="price_afterdiscount" placeholder="Harga Setelah Diskon" class="form-control priceformatnopfx"/>
											 <label id="price_afterdiscount_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Field ini harus di isi</label>
                     </div>
									 </div>
									 <div class="form-group" id="expired_date"style="display:none" >
                     <label for="discount_type" class="col-sm-5 control-label" style="text-align:left">
                       <b style="text-align:right;">Berlaku Hingga Tanggal</b> <br />
                       <i style="font-size:12px;">Tentukan tanggal masa berlaku untuk diskon yang akan ditambahkan</i>
                     </label>
                     <div class="col-sm-5">
											 <input type="hidden" name="" value="" id="interval">
											 <input type="" name="date_expired" value="" id="date_expired"  data-toggle="datepicker" placeholder="Tanggal Berlaku" class="form-control date_expired"/>
											 <label id="date_expired_error" class="control-label" style="color:#a94442;display:none;"><i class="fa fa-ban"></i> Field ini harus di isi</label>
                     </div>
									 </div>
						 </form>
						 <hr>
						 <div class="" style="text-align:center">
						 		<button type="button"class="btn btn-primary" id="submit_discount" name="submit_discount">Set Diskon</button>
						 </div>
<!-- ============================= End Of Diskon Produk ========================= !-->
<hr>
<h4 style="text-align:center"><b>Daftar Diskon Sebelumnya</b></h4>
<table class="table table-bordered table-striped table-hover" id="table2" style="width:100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>Minimum Pembelian</th>
			<th>Jenis Diskon</th>
			<th>Nilai Diskon</th>
			<th>Tanggal Mulai Berlaku</th>
			<th>Tanggal Diskon Berakhir</th>
			<th>Harga Setelah Diskon</th>

		</tr>
	</thead>
	<tbody>
	<?php $no=1; foreach( $discount_list as $disc_list ) {?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $disc_list->min_qty_discount ?></td>
			<td><?php echo $disc_list->discount_type ?></td>
			<td>
				<?php if ($disc_list->discount_type =='persen'){ ?>
						<span class="priceformatnopfx"><?php echo $disc_list->discount_value ?></span>
				<?php }else{ ?>
						<span class="priceformat"><?php echo $disc_list->discount_value ?></span>
				<?php	} ?>
			</td>
			<td><?php echo mediumdate_indo("$disc_list->date_created_discount") ?></td>
			<td><?php echo mediumdate_indo("$disc_list->date_expired") ?>
				<input type="hidden" name="" value="<?php echo $disc_list->date_expired ?>" id="last_date_expired">
			</td>
			<td>
					<span class="priceformat"><?php $symbol = $disc_list->symbol ?><?php echo $disc_list->price_afterdiscount ?></span>
			</td>
		</tr>
	<?php $no++; } ?>
	</tbody>
</table>
<input type="hidden" name="" value="" id="date_today">
<script>
	$(function() {
      $('[data-toggle="datepicker"]').datepicker({format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
      });
    });
	$(document).ready(function(){
		$('#discount_value').val(0);
		$('#price_afterdiscount').val(0);
	  $('#table2').DataTable({
      'scrollX': true,
    });
		$('.d').datepicker({
			autoclose: true
		});

		$('#discount_type').change(function() {
			var price = document.getElementById("price").value;
			if (!$('#discount_type').val()) {
					discount_value.style.display = 'none';
					input_price_afterdiscount.style.display = 'none';
					expired_date.style.display = 'none';
						$('#discount_value').val(0);
						$('#price_afterdiscount').val(price);
			}else{
				discount_value.style.display = 'block';
				input_price_afterdiscount.style.display = 'block';
				expired_date.style.display = 'block';
				$('#discount_value').val(0);
				$('#price_afterdiscount').val(price);
				var	discount_type =  $('#discount_type').val();
				if (discount_type =='rupiah') {
						document.getElementById('discount_value').addClass('priceformat');
						document.getElementById('discount_value').removeClass('priceformat2L');
				}else if (discount_type == 'persen') {
						document.getElementById('discount_value').addClass('priceformat2L');
						document.getElementById('discount_value').removeClass('priceformat');
				}
			}
		});

		$(function() {
			$('.priceformat').priceFormat({
				prefix: '<?php echo $symbol ?>.',
				thousandsSeparator: '.',
				clearOnEmpty: true,
				centsLimit: 0,
				limit:9
			});
			$('.priceformatnopfx').priceFormat({
				prefix: '',
				thousandsSeparator: '.',
				clearOnEmpty: true,
				centsLimit: 0,
				limit:9
			});
			$('.priceformat2L').priceFormat({
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
		});

		var price = document.getElementById("price").value;
		$('#date_expired').change(function() {
			var date_today = moment().format('YYYY-MM-DD');
			var date_expired = moment(new Date($('#date_expired').val()));
			moment.locale('id');
			//var interval   = moment(date_expired, "YYYY-MM-DD").fromNow();
			var interval = date_expired.diff(date_today, 'days');
			$('#interval').val(interval);
		});
		$('#discount_value').keyup(function() {
			var	discount_type =  $('#discount_type').val();
			var disc_val = $('#discount_value').unmask();
			//alert('fef'+discount_type);
			if (discount_type == 'rupiah') {

				var price_afterdiscount = price - disc_val;
				$('#price_afterdiscount').val(price_afterdiscount);
				if (price_afterdiscount < 0) {
					alert('Diskon yang anda masukkan melebihi harga produk');
					$('#price_afterdiscount').val(price);
					$('#discount_value').val(0);
				}
			}else if (discount_type == 'persen') {
				var price_discount = price *(disc_val/100);
				var price_afterdiscount = price - price_discount;
				$('#price_afterdiscount').val(price_afterdiscount);
				if (disc_val > 99) {
						alert('Nilai diskon yang anda masukkan melebihi batas maksimal');
						$('#price_afterdiscount').val(price);
						$('#discount_value').val(0);
				}
			}
			$('#krg').val(disc_val);
		//alert('fewf'+discount_type);// get the current value of the input field.
		});// End Of #discount Value Keyup

		//Submit Discount Click
		$('#submit_discount').click(function(){
			var min_qty_discount	= $('#min_qty_discount').unmask();
			var discount_type 		= $('#discount_type').val();
			var discount_value		= $('#discount_value').unmask();
			//var discount_value    = disc_val;
			var price_afterdiscount = $('#price_afterdiscount').unmask();
			var date_expired			= $('#date_expired').val();
			var product_id				= $('#product_id').val();
			var currency_id				= $('#currency_id').val();

			if (!min_qty_discount) {
				$("#label_error").animate({ scrollTop: 0 }, "fast");$("#min_qty_discount").addClass("has-input-error");min_qty_discount_error.style.display = 'block';
			}else{
				$("#min_qty_discount").removeClass("has-input-error");label_error.style.display = 'none';min_qty_discount_error.style.display = 'none';
			}
			if (!discount_type) {
				$("#label_error").animate({ scrollTop: 0 }, "fast");$("#discount_type").addClass("has-input-error");discount_type_error.style.display = 'block';
			}else{
				$("#discount_type").removeClass("has-input-error");label_error.style.display = 'none';discount_type_error.style.display = 'none';
			}
			if (!discount_value) {
				$("#label_error").animate({ scrollTop: 0 }, "fast");$("#discount_value").addClass("has-input-error");discount_value_error.style.display = 'block';
			}else{
				$("#discount_value").removeClass("has-input-error");label_error.style.display = 'none';discount_value_error.style.display = 'none';
			}
		if (!price_afterdiscount) {
			$("#label_error").animate({ scrollTop: 0 }, "fast");$("#price_afterdiscount").addClass("has-input-error");price_afterdiscount_error.style.display = 'block';
		}else{
			$("#price_afterdiscount").removeClass("has-input-error");label_error.style.display = 'none';price_afterdiscount_error.style.display = 'none';
		}
		if (!date_expired) {
			$("#label_error").animate({ scrollTop: 0 }, "fast");$("#date_expired").addClass("has-input-error");date_expired_error.style.display = 'block';
		}else{
			$("#date_expired").removeClass("has-input-error");label_error.style.display = 'none';date_expired_error.style.display = 'none';
		}
		if (!min_qty_discount || !discount_type || !discount_value || !price_afterdiscount || !date_expired) {
			label_error.style.display = 'block';
			$("#label_error").animate({ scrollTop: 0 }, "fast");
		}
		if (!!min_qty_discount && !!discount_type && !!discount_value && !!price_afterdiscount && !!date_expired) {
				if ($('#interval').val() < 1) {
						alert('Tanggal masa berlaku diskon tidak sesuai');
				}
				else{
					var date_today = moment().format('YYYY-MM-DD');
					var last_date_expired = moment(new Date($('#last_date_expired').val()));
					var interval = last_date_expired.diff(date_today, 'days');
					if (interval >0) {
						alert('Masih ada diskon yang berlaku');
					}else{
						$.ajax({
								url:"<?php echo site_url('admin/product/ajaxCreateProductDiscount');?>",
								type:"POST",
								data:"min_qty_discount="+min_qty_discount
										+"&discount_type="+discount_type
										+"&discount_value="+discount_value
										+"&price_afterdiscount="+price_afterdiscount
										+"&date_expired="+date_expired
										+"&product_id="+product_id
										+"&currency_id="+currency_id
										+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
								cache:false,
								success:function(result){
									swal('Diskon berhasil disimpan');
									$('.modal_discount').modal('hide');
										window.location.reload(true);
								}
						});
					}
				}
			}
		});//End Of Submit Discount Click
  }); //End Of Document.Ready

</script>
