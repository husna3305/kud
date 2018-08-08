<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Brand</th>
			<th>Harga</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

	<?php $no=1; foreach( $product_list as $product_l ) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $product_l->pd_name ?></td>
			<td><?php echo $product_l->brand_name ?></td>
			<td><?php echo $product_l->price ?></td>
			<td align=center>
				<button name="" type="button" class="combine_product_add btn btn-primary btn-mini"
				 product_id="<?php echo $product_l->product_id ?>" 
				 pd_name="<?php echo $product_l->pd_name ?>"
				 price="<?php echo $product_l->price ?>"
				>
					<i class="glyphicon glyphicon-plus"></i>
				</button>
			</td>
		</tr>
	<?php $no++; } ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).on("click",".combine_product_add",function(){
      var product_id=$(this).attr('product_id');
      var pd_name=$(this).attr('pd_name');
      var price=$(this).attr('price');
  		$('#product_name').val(pd_name);
  		$('#price_add').val(price);
        $('#product_id_combine_add').val(product_id);
  		$("#modal_searchproduct").modal("hide");
	})
</script>