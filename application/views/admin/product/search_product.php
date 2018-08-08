<?php echo $count_search ?>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Brand</th>
			<th>SKU</th>
			<th>Harga</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

	<?php $no=1; foreach( $product_list as $product_l ) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $product_l->name ?></td>
			<td><?php echo $product_l->brand_id ?></td>
			<td><?php echo $product_l->sku ?></td>
			<td><?php echo $product_l->price ?></td>
			<td align=center>
				<button name="" type="button" class="combine_product_add btn btn-primary btn-mini"
					name_<?php echo $count_search ?> = "<?php echo $product_l->name ?>"
					product_id_<?php echo $count_search ?> = "<?php echo $product_l->product_id ?>"
					price_<?php echo $count_search ?> = "<?php echo $product_l->price ?>"
					count_search = "<?php echo $count_search ?>"

				>
					<i class="glyphicon glyphicon-plus"></i>
				</button>
			</td>
		</tr>
	<?php $no++; } ?>
	</tbody>
</table>
