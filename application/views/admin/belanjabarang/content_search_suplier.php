<table class="table table-bordered table-striped table-condensed table-hover" id="tbl_suplier">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">Suplier</th>
		<th style="text-align: center;">Aksi</th>
	</thead>
	<tbody>
		<?php foreach ($suplier->result() as $spr): ?>
			<tr>
				<td>
					<table width="40%">
						<tr>
							<td>Nama Suplier</td><td>:</td><td><?php echo $spr->nama_suplier ?></td>
						</tr>
						<tr>
							<td>Alamat</td><td>:</td><td><?php echo $spr->alamat ?></td>
						</tr>
						<tr>
							<td>No. Telp / No. HP</td><td>:</td><td><?php echo $spr->no_telp ?></td>
						</tr>
					</table>
				</td>

				<td align="center" style="width: 10%;vertical-align: middle;">
					<button type="button" 
						class="btn btn-primary btn-sm btn_pilih-kategori" 
						id_suplier = "<?php echo $spr->id_suplier ?>"
						nama_suplier = "<?php echo $spr->nama_suplier ?>"
					>Pilih</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
        var mytable = $("#tbl_suplier").DataTable({
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
      var id_suplier=$(this).attr('id_suplier');
      var nama_suplier=$(this).attr('nama_suplier');
  		$('#id_suplier').val(id_suplier);
  		$('#nama_suplier').val(nama_suplier);
  		$(".modal_cari-suplier").modal("hide");
	})
</script>