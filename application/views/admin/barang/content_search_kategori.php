<table class="table table-bordered table-striped table-condensed table-hover" id="table1">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">Nama Kategori</th>
		<th style="text-align: center;">Aksi</th>
	</thead>
	<tbody>
		<?php foreach ($root_kategori->result() as $r_k): ?>
			<tr>
				<td><b><?php echo $r_k->nama_kategori ?></b></td>
				<td align="center" style="width: 10%">
					<button type="button" 
						class="btn btn-primary btn-xs btn_pilih-kategori" 
						id_kategori = "<?php echo $r_k->id_kategori ?>"
						nama_kategori = "<?php echo $r_k->nama_kategori ?>"
					>Pilih</button>
				</td>
			</tr>
			<?php foreach ($kategori->result() as $ktg): ?>
				<?php if ($ktg->parent_id == $r_k->id_kategori): ?>
					<tr>
						<td>>&nbsp;<?php echo $ktg->nama_kategori ?></td>
						<td align="center" style="width: 10%">
							<button type="button" 
								class="btn btn-primary btn-xs btn_pilih-kategori" 
								id_kategori = "<?php echo $ktg->id_kategori ?>"
								nama_kategori = "<?php echo $ktg->nama_kategori ?>"
							>Pilih</button>
						</td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
		<?php endforeach ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).on("click",".btn_pilih-kategori",function(){
      var id_kategori=$(this).attr('id_kategori');
      var nama_kategori=$(this).attr('nama_kategori');
  		$('#id_kategori').val(id_kategori);
  		$('#nama_kategori').val(nama_kategori);
  		$(".modal_cari-kategori").modal("hide");
	})
</script>