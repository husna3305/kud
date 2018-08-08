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
				<input type="hidden" value="<?php echo $product->currency_id ?>" id="currency_id"/> <?php $symbol=$product->symbol ?>
		</td>
	</tr>
</table>

<!-- ================================================================================================-->
<style media="screen">
	.center{
		text-align: center;
		vertical-align: middle;
	}
</style>
<table class="table table-bordered table-condensed table-striped" style="width:100%" >
	<thead>
		<tr >
			<th rowspan=2 class="center">No.</th>
			<th colspan=2 class="center">Total Produk</th>
			<th rowspan=2 class="center">Harga</th>
			<th rowspan=2 class="center"></th>
		</tr>
		<tr>
			<th class="center">Min</th>
			<th class="center">Max</th>
		</tr>
	</thead>
	<tbody>
			<?php $x=0; foreach ($wholesale_list as $w_l): $x++;?>
				<tr class="c_wholesale">
					<td class="center"><?php echo $x ?>.</td>
					<td class="center" style="width:40%">
						<input type="text" id="min_<?php echo $x ?>" count="<?php echo $x ?>" name="" class="min qty_format" value="<?php echo $w_l->min_qty ?>" style="width:40%">
						<input type="hidden" id="wholesale_id_<?php echo $x ?>" count="<?php echo $x ?>" name="" class="min qty_format" value="<?php echo $w_l->wholesale_id ?>" style="width:40%" readonly>
					</td>
					<td class="center" style="width:40%">
						<input type="text" id="max_<?php echo $x ?>" count="<?php echo $x ?>" name="" class="max qty_format" value="<?php echo $w_l->max_qty ?>" style="width:40%">
					</td>
					<td class="center"><input type="text" name="" value="<?php echo $w_l->price ?>" count="<?php echo $x ?>" id="price_<?php echo $x ?>" class="price_disc_input priceformatnopfx"></td>
					<td class="center "style="text-align:center;"><button type="button" count="<?php echo $x ?>" id="remove_item_wholesale_<?php echo $x ?>" style="display:none;text-align:center;" class="remove_item_wholesale btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
				</tr>
				<tr>
					<td colspan="5">
						<span class="wrapword" id="error_<?php echo $x ?>" style="color:red;font-size: 11px;display:none">ddd</span>
					</td>
				</tr>
			<?php ; endforeach; ?>
			<input type="hidden" name="" value="<?php echo $x ?>" id="x_wholesale_upd">
			<?php for ($i=$x+1; $i <= 10; $i++) { ?>
				<tr class="c_wholesale">
					<td class="center"><?php echo $i ?>.</td>
					<td class="center" style="width:40%"><input type="text" count="<?php echo $i ?>" id="min_<?php echo $i ?>" name="" class="min qty_format" value="" style="width:40%"></td>
					<td class="center" style="width:40%"><input type="text" count="<?php echo $i ?>" id="max_<?php echo $i ?>" name="" class="max qty_format" value="" style="width:40%"></td>
					<td class="center"><input type="text" name="" value=""  count="<?php echo $i ?>" id="price_<?php echo $i ?>" class="price_disc_input priceformatnopfx"></td>
					<td class="center" style="text-align:center;"><button type="button" count="<?php echo $i ?>"  id="remove_item_wholesale_<?php echo $i ?>" style="display:none;" class="remove_item_wholesale btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
				</tr>
				<tr>
					<td colspan="5">
						<span class="wrapword" id="error_<?php echo $i ?>" style="color:red;font-size: 11px;display:none">ddd</span>
					</td>
				</tr>
			<?php } ?>
	</tbody>
</table>
<div class="" style="text-align:center">
	 <button type="button"class="btn btn-primary" id="submit_wholesale" name="submit_wholesale">Set Harga Grosir</button>
</div>
<script type="text/javascript">
	$(document).ready(function(){
			for (var i = <?php echo $x ?>+2; i <= 10; i++ ){
					$("#min_"+i).prop('disabled', true);
					$("#max_"+i).prop('disabled', true);
					$("#price_"+i).prop('disabled', true);
			}
			for (var i = 1; i <= <?php echo $x ?>; i++) {
					document.getElementById("remove_item_wholesale_"+i).style.display = 'block';
			}
			var min_error= new Array();
			var max_error= new Array();
			var price_wholesale_error = new Array();

			function enable_input(count){
				var min=parseInt($('#min_'+count).unmask());
				var max = parseInt($('#max_'+count).unmask());
				var price = parseInt($('#price_'+count).unmask());
				var count_after = count+1;

				if (!!price && !!max && !!min) {
					$("#min_"+count_after).prop('disabled', false);
					$("#max_"+count_after).prop('disabled', false);
					$("#price_"+count_after).prop('disabled', false);
					document.getElementById("remove_item_wholesale_"+count).style.display = 'block';
				}else{
					var min_after=parseInt($('#min_'+count_after).val());
					var max_after = parseInt($('#max_'+count_after).val());
					var price_after = parseInt($('#price_'+count_after).val());
					if (!!min_after && !!max_after && !!price_after) {
						$("#min_"+count_after).prop('disabled', false);
						$("#max_"+count_after).prop('disabled', false);
						$("#price_"+count_after).prop('disabled', false);
					}else{
						document.getElementById("remove_item_wholesale_"+count).style.display = "none";
						$("#min_"+count_after).prop('disabled', true);
						$("#max_"+count_after).prop('disabled', true);
						$("#price_"+count_after).prop('disabled', true);
					}
				}
			}
			function check_error(){
				var min_error_tot =0;
				var max_error_tot =0;
				var price_wholesale_error_tot =0;
				//Check error condition for min, max and price wholesale
				for (var i = 1; i <=10; i++) {
					if (!!min_error[i]) {
						min_error_tot += min_error[i];
					}
					if (!!max_error[i]) {
						max_error_tot += max_error[i];
					}
					if (!!price_wholesale_error[i] ) {
						price_wholesale_error += price_wholesale_error[i];
					}
				}
				return {
					min_error_tot : min_error_tot,
					max_error_tot : max_error_tot,
					price_wholesale_error_tot : price_wholesale_error_tot
				}
			}

			// Validate Minimum Qty
			$('.min').keyup(function() {
					var count=$(this).attr("count");
					var min=parseInt($('#min_'+count).unmask());
					var max = parseInt($('#max_'+count).unmask());

					if (count > 1) {
						var count_before = count-1;
						var max_before=parseInt($('#max_'+count_before).unmask());
						if (min < max_before+1) {
							document.getElementById("error_"+count).style.display = 'block';
							$('#error_'+count).text('Nilai tidak valid');
							min_error[count] = 1;
						}else if(min >= max){
							document.getElementById("error_"+count).style.display = 'block';
							$('#error_'+count).text('Nilai tidak valid');
							min_error[count] = parseInt(1);
						}else{
							document.getElementById("error_"+count).style.display = 'none';
							min_error[count] = 0;
						}
					}
					if (count == 1) {
						if (min >= max) {
							document.getElementById("error_"+count).style.display = 'block';
							$('#error_'+count).text('Nilai tidak valid');
							min_error[count] = parseInt(1);
						}else{
							document.getElementById("error_"+count).style.display = 'none';
							min_error[count] = parseInt(0);
						}
					}

					var x =enable_input(count);
			});

			// Validate Minimum Qty
			$('.max').keyup(function() {
					var count						= parseInt($(this).attr("count"));
					var count_after			= count+1;
					var max							= parseInt($('#max_'+count).unmask());
					var min_after				= parseInt($('#min_'+count_after).unmask());
					var min							= parseInt($('#min_'+count).unmask());
						if (count > 1) {
							var count_before		= count-1;
							var max_before			= parseInt($('#max_'+count_before).unmask());
							if (max < min+1) {
								document.getElementById("error_"+count).style.display = 'block';
								document.getElementById("error_"+count_after).style.display = 'none';
								$('#error_'+count).text('Nilai tidak valid');
								max_error[count] = 1;
							}else if(max >= min_after){
								document.getElementById("error_"+count_after).style.display = 'block';
								$('#error_'+count_after).text('Nilai tidak valid');
								document.getElementById("error_"+count).style.display = 'none';
								max_error[count_after] = 1;
							}else if(min < max_before){
								document.getElementById("error_"+count).style.display = 'block';
								$('#error_'+count).text('Nilai tidak valid');
								 max_error[count] = 1;
							}
							else{
								document.getElementById("error_"+count).style.display = 'none';
								max_error[count] = 0;
							}
						}else if (count==1) {
								if (max <= min) {
									document.getElementById("error_"+count).style.display = 'block';
									document.getElementById("error_"+count_after).style.display = 'none';
									$('#error_'+count).text('Nilai tidak valid');
									max_error[count] = 1;
								}
								else if(max >= min_after){
									document.getElementById("error_"+count_after).style.display = 'block';
									$('#error_'+count_after).text('Nilai tidak valid');
									document.getElementById("error_"+count).style.display = 'none';
									max_error[count_after] = 1;
								}
								else if (max > min) {
										document.getElementById("error_"+count).style.display = 'none';
										max_error[count] = 0;
								}
								else{
									document.getElementById("error_"+count).style.display = 'none';
									max_error[count] = 0;
								}
						}
						var x =enable_input(count);
			});

			$('.price_disc_input').keyup(function() {
					var count			 		= parseInt($(this).attr("count"));
					var price			 		= parseInt($('#price_'+count).unmask());
					var price_pass 		= parseInt($('#price').unmask());
					if (count > 1) {
						var count_after	= count+1;
						var price_after=parseInt($('#price_'+count_after).unmask());
						var count_before 	= count-1;
						var price_before=parseInt($('#price_'+count_before).unmask());
						if (price >= price_before) {
							document.getElementById("error_"+count).style.display = 'block';
							$('#error_'+count).text('Nilai tidak valid, harga grosir yang dimaksukkan harus lebih kecil dari harga grosir sebelumnya');
							price_wholesale_error[count] = 1;
						}
						else if (price < price_after) {
							document.getElementById("error_"+count_after).style.display = 'block';
							$('#error_'+count_after).text('Nilai tidak valid, harga grosir yang dimaksukkan tidak sesuai');
							price_wholesale_error[count] = 1;
						}
						else {
							document.getElementById("error_"+count).style.display = 'none';
							price_wholesale_error[count] = 0;
						}
					}
					else if (count==1) {
						var count_after	= count+1;
						var price_after=parseInt($('#price_'+count_after).unmask());
						if (price >= price_pass) {
							document.getElementById("error_"+count).style.display = 'block';
							$('#error_'+count).text('Nilai tidak valid, harga grosir yang dimaksukkan harus lebih kecil dari harga pas');
							price_wholesale_error[count] = 1;
						}else if (price < price_after) {
							document.getElementById("error_"+count_after).style.display = 'block';
							$('#error_'+count_after).text('Nilai tidak valid, harga grosir yang dimaksukkan tidak sesuai');
							price_wholesale_error[count] = 1;
						}
						else{
							document.getElementById("error_"+count).style.display = 'none';
							price_wholesale_error[count] = 0;
						}
					}
					var x =enable_input(count);
			});
			$('.remove_item_wholesale').click(function(){
					var count=$(this).attr("count");
					count_after=count+1;
					for (var i = count; i <=10; i++) {
						if (i ==count) {
							document.getElementById('min_'+i).value = '';
							document.getElementById('max_'+i).value = '';
							document.getElementById('price_'+i).value = '';
							$("#min_"+i).prop('disabled', false);
							$("#max_"+i).prop('disabled', false);
							$("#price_"+i).prop('disabled', false);
							document.getElementById("remove_item_wholesale_"+count).style.display = 'none';
						}else if(i > count){
							document.getElementById('min_'+i).value = '';
							document.getElementById('max_'+i).value = '';
							document.getElementById('price_'+i).value = '';
							$("#min_"+i).prop('disabled', true);
							$("#max_"+i).prop('disabled', true);
							$("#price_"+i).prop('disabled', true);
							document.getElementById("remove_item_wholesale_"+i).style.display = 'none';
						}
					}
			});//End Of .remove_item_wholesale

			$('#submit_wholesale').click(function(){
				var ce = check_error();
				if(ce.min_error_tot==0 && ce.max_error_tot==0 && ce.price_wholesale_error_tot == 0)
				{
					data_wholesale_upd 	 = new Array();
					data_wholesale_add 	 = new Array();
					var x_wholesale_upd	 = parseInt($('#x_wholesale_upd').val());
					var product_id				 = <?php echo $product->product_id ?>;

					for (var x= 1; x <= x_wholesale_upd; x++) {
							data_wholesale_upd.push({
								"min_qty" : parseInt($('#min_'+x).unmask()),
								"max_qty" : parseInt($('#max_'+x).unmask()),
								"price" : parseInt($('#price_'+x).unmask()),
								"wholesale_id" : $('#wholesale_id_'+x).val(),
								"product_id" : product_id
							})
					}
					var jsonWholesaleUpd = JSON.stringify(data_wholesale_upd);

					var x_wholesale_upd_1 = x_wholesale_upd+1;
					var check_input=0;
					for (var i = x_wholesale_upd_1; i <= 10; i++) {
						var min = parseInt($('#min_'+i).unmask());
						var max = parseInt($('#max_'+i).unmask());
						var price = parseInt($('#price_'+i).unmask());

						if (!!min && !!max && !!price) {
							check_input++;
							data_wholesale_add.push({
								"min_qty" 			: min,
								"max_qty" 			: max,
								"price" 				: price,
								"product_id" 		: product_id
							})
						}
					}
					var jsonWholesaleAdd = JSON.stringify(data_wholesale_add);

					$.ajax({
							url:"<?php echo site_url('admin/product/ajaxUpdWholesaleProduct');?>",
							type:"POST",
							data:"data="+jsonWholesaleUpd
										+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
							//dataType : 'json',
							cache:false,
							success:function(result){
									if (check_input==0) {
										alert('Harga grosir	 berhasil disimpan');
										$('.modal_wholesale').modal('hide');
										window.location.reload(true);
									}
							}

					});
					if (check_input>0) {
						$.ajax({
								url:"<?php echo site_url('admin/product/ajaxAddWholesaleProduct');?>",
								type:"POST",
								data:"data="+jsonWholesaleAdd
											+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
								//dataType : 'json',
								cache:false,
								success:function(result){
									alert('Harga grosir	 berhasil disimpan');
									$('.modal_wholesale').modal('hide');
									window.location.reload(true);
								}

						});

					}
				}
			});

	});
</script>
<!-- ================================================================================================-->
<script>

	$(document).ready(function(){
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

  }); //End Of Document.Ready

</script>
