

<table class="table table-bordered table-striped table-condensed table-hover" id="data_table">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">Uraian Data Barang</th>
		<th style="text-align: center;">Aksi</th>
	</thead>
	<tbody>
		<?php foreach ($barang->result() as $brg): ?>
			<tr>
				<td class="filterable-cell">
					Nama Barang : <?php echo $brg->nama_barang ?><br>
					Kategori : <?php if($brg->root_kategori<>null){?> <?php echo $brg->root_kategori ?>,&nbsp;<?php } ?><?php echo $brg->nama_kategori ?>
				</td>
				<td align="center" style="width: 10%;vertical-align: middle;">
					<button type="button" 
						class="btn btn-primary btn-sm btn_pilih-kategori filterable-cell" 
						id_barang = "<?php echo $brg->id_barang ?>"
						nama_barang = "<?php echo $brg->nama_barang ?>"
					>Pilih</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
        var mytable = $("#data_table").DataTable({
            columnDefs: [
                {
                    targets: 0
                }
            ],
            
            order: [[1, 'asc']],
            "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         true
        });

    });
	$(document).on("click",".btn_pilih-kategori",function(){
      var id_barang=$(this).attr('id_barang');
      var nama_barang=$(this).attr('nama_barang');
  		$('#id_barang').val(id_barang);
  		$('#nama_barang').val(nama_barang);
  		$(".modal_cari-barang").modal("hide");
	})
</script>