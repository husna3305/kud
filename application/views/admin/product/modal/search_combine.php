<style media="screen">
	.has-input-error{
		border-color: #a94442;
	}
</style>
	<div class="form-horizontal" ">
		<div class="form-group" style="padding-left: 20px">
			 <div class="col-sm-10">
			   <input type="hidden" name="product_id_combine_add" value="" id="product_id_combine_add" class="form-control"/>
			   <input type="hidden" name="price_add" value="" id="price_add" class="form-control"/>
			   <input type="text" name="product_name" value="" id="product_name" class="form-control" readonly placeholder="Tambah Produk" />
			 </div>
			 <div class="col-sm-1">
			 	<a data-toggle="modal" id="show_modalsearchproduct" href="#modal_searchproduct" class="btn" style="background-color: #00c0ef;color: white;"><i class="fa fa-search"></i></a>
			 </div>
		</div>
		<div class="form-group" >
			<div class="col-sm-12 center" style="text-align: center">
				<button class="btn btn-primary" id="btn_add_combine">Tambah Produk</button>
			</div>
		</div>
	</div><hr style="margin: 0px">

<table class="table" style="width:100%">
	<thead>
		<tr>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Potongan Harga</th>
			<th>Harga AKhir</th>
		</tr>
	</thead>
	<tbody id="combine_products_add">
		<tr>
		<td class="wrapword">
		<?php echo $product->name ?><br>
		<i style="color: green;font-size: 11px;">Produk Utama</i></td>
		<td>
			<span class="priceformat"><?php echo $product->price ?></span>
			<input type="hidden" value="<?php echo $product->price ?>" id="price"/>
				<?php
					$product_id = $this->encrypt->encode($product->product_id);
					$product_id = strtr($product_id,array('+' => '.', '=' => '-', '/' => '~')); ?>
				<input type="hidden" id="main_product_id" value="<?php echo $product_id ?>" />
				<input type="hidden" value="<?php echo $product->currency_id ?>" id="currency_id"/><?php $symbol=$product->symbol ?>
		</td>
		<td><input type="text" name="" disabled></td><td><input type="text" name="" disabled></td>
	</tr>
	</tbody>
</table>
<input type="hidden" name="count_combine" id="count_combine" value="<?php echo $count_combine ?>">
<input type="hidden" name="count_combine" id="count_combine_total"/>
<input type="hidden" name="jj" id="jj"/>

<script>
	$(document).ready(function(){
		var array_check_combine_add = new Array();
		/* Menampilkan Produk Kombinasi Yang Sudah Disimpan */
		<?php if ($count_combine > 0) {?>
			<?php $count=1;foreach ($combine_list as $cl): ?>
				$('#count_combine_total').val(<?php echo $count ?>);
					$("#combine_products_add").append('<tr class="records_combine">'
					+'<td><?php echo $cl->name ?></td>'
					+'<td><span class="priceformat"><?php echo $cl->price ?></span> <span style="display:none;" id="price_add_<?php echo $count?>"><?php echo $cl->price ?></span></td>'
					+'<td><input type="text" class="price_cut" data-count_combine_add="<?php echo $count ?>" id="price_cut_<?php echo $count ?>" name="price_cut_<?php echo $count ?>" value="<?php echo $cl->price_cut ?>" class="" /><input type="hidden" name="combine_id_<?php echo $cl->combine_id ?>"/></td>'
					+'<td><input type="text" id="price_combine_<?php echo $count ?>" name="price_combine_<?php echo $count ?>" value="<?php echo $cl->price_combine ?>" class="" /> <input type="hidden" name="combine_product_<?php echo $count ?>" id="combine_product_<?php echo $count ?>" value="<?php echo $cl->combine_product ?>" readonly/></td>'
					+'<td><button type="button" class="btn btn-xs btn-danger btn_deletecombine" combine_product="<?php echo $cl->combine_product ?>" combine_id="<?php echo $cl->combine_id?>"><i class="fa fa-trash"></i></button></td>'
					+'</tr>');
				 array_check_combine_add.push("<?php echo $cl->combine_product ?>");
			<?php $count++; endforeach ?>
		<?php } ?>
		/* End Menampilkan Produk Kombinasi Yang Sudah Disimpan */
		var jj=array_check_combine_add.join();
		$('#jj').val(jj);

		/* Menampilkan Modal Pencarian Produk */
		$('#show_modalsearchproduct').click(function(e){
			e.preventDefault();
			$('.modal_searchproduct').modal('show');
			$.ajax({
	               url:"<?php echo site_url('admin/product/ajaxSearchProductCombine')?>",
	               type:"POST",
	               data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
	               cache:false,
	               success:function(html){
	                  $("#show_search_product").html(html);
	               }
	          })
		});
		/* End Of Menampilkan Modal Pencarian Produk */

		/* Tambah Inputan */
		var count_combine = parseInt($('#count_combine').val());
		var count_combine_add = count_combine +1;
		var check_count_combine=count_combine +1;
		$('#btn_add_combine').click(function(){
			var name = $('#product_name').val();
			var price_add = $('#price_add').val();
			var product_id_combine_add = $('#product_id_combine_add').val();
			var check_combine_add = array_check_combine_add.includes(product_id_combine_add);
			var main_product_id = $('#main_product_id').val();
			if (<?php echo $product->product_id ?>==product_id_combine_add) {
				swal('Produk Yang Dipilih Adalah Produk Utama');
			}else{
				if (check_combine_add==true)
				{
					swal('Produk Yang Dipilih Sudah Ada Dalam Daftar');
				}else
				{
					//swal('Produk Yang Dipilih Adalah Produk Utama'+main_product_id+'--'+product_id_combine_add);
					$("#combine_products_add").append('<tr class="records_combine">'
					+'<td>'+name+'</td>'
					+'<td><span class="priceformat" id="price_add_'+count_combine_add+'">'+price_add+'</span></td>'
					+'<td><input type="text" name="price_cut_'+count_combine_add+'" id="price_cut_'+count_combine_add+'" data-count_combine_add="'+count_combine_add+'" class="price_cut priceformatnopfx" /></td>'
					+'<input type="hidden" id="combine_product_'+count_combine_add+'" name="combine_product_'+count_combine_add+'" value="'+product_id_combine_add+'" />'
					+'<td><input type="text" name="price_combine_'+count_combine_add+'" id="price_combine_'+count_combine_add+'" value="'+price_add+'" readonly/></td>'
					+'<td><button type="button" combine_product="'+product_id_combine_add+'" class="btn btn-xs btn-danger btn_deletecombine"><i class="fa fa-trash"></i></button></td>'
					+'</tr>'
					);
					$('#count_combine_total').val(count_combine_add);
					count_combine_add++;
					check_count_combine++;
					array_check_combine_add.push(product_id_combine_add);
				}
				var jj=array_check_combine_add.join();
		$('#jj').val(jj);

			}
		});
		/* End Tambah Inputan */


		/* Proses Perhitungan Pemotongan Harga  */
		$('#combine_products_add').on('keyup','.price_cut',function(){
			var count_combine_add = $(this).data('count_combine_add');
			var price = parseInt($('#price_add_'+count_combine_add).text()) ;
			var price_cut = parseInt($('#price_cut_'+count_combine_add).val());
			if (price_cut > price) {
				$('#price_cut_'+count_combine_add).val(price);
				$('#price_combine_'+count_combine_add).val("0");

			}else{
				var price_combine;
				price_combine = price-price_cut;
				$('#price_combine_'+count_combine_add).val(price_combine);
			}
			if (!price_cut) {
				$('#price_combine_'+count_combine_add).val(price);
				//$('#price_cut_'+count_combine_add).val(0);
			}
			if (price_cut<100) {
				$('#price_combine_'+count_combine_add).val(price);
			}
		});
		/*  End Proses Perhitungan Potongan Harga */

		/* Menghapus Satu Kombinasi Produk */
		var data_delete_combine = new Array();
		$(document).on("click",".btn_deletecombine",function(ev){
			var combine_id=$(this).attr('combine_id');
			var combine_product=$(this).attr('combine_product');
	        if (ev.type == 'click') {
				//check_count_wholesale = check_count_wholesale - 1;
				if (!!combine_id) {
					data_delete_combine.push({
                     "combine_id" : combine_id,
                   })
				}
			}
			$(this).parents(".records_combine").remove();
			/* menghapus Array Produk Kombinasi Yang Ditambah */
			var index = array_check_combine_add.indexOf(combine_product);
			if (index > -1) {
			  array_check_combine_add.splice(index, 1);
			}
			/* End Of menghapus Array Produk Kombinasi Yang Ditambah */
		})
		/* End Of Menghapus Satu Kombinasi Produk */

		$('#btn_combine_submitxxxxxx').click(function(){
			var count_combine = $('#count_combine_total').val();
			data_combine = new Array();
                 for (var i = 1; i <= count_combine; i++) {
                   data_combine.push({
                     "main_product_id" : $('#main_product_id').val(),
                     "combine_product" : $('#combine_product_'+i).val(),
                     "price_cut" : parseInt($('#price_cut_'+i).val()),
                     "price_combine" : parseInt($('#price_combine_'+i).val()),
                   })
                 }
            var jsonString = JSON.stringify(data_combine);
            var jsonDeleteCombine = JSON.stringify(data_delete_combine);

            $.ajax({
	             url:"<?php echo site_url('admin/product/ajaxCreateCombineProduct');?>",
	             type:"POST",
	             data:"data="+jsonString+"&datadelete="+jsonDeleteCombine
	                   +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
	             //dataType : 'json',
	             cache:false,
	             success:function(result){
	             	swal('Data Berhasil Disimpan');
	             	$("#modalCombine").modal("hide");
	             	window.location.reload(true);
	             }
	        })
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
	});
</script>