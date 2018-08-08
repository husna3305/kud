<table class="table table-bordered table-striped table-condensed table-hover" id="tbl_kelompoktani">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">Suplier</th>
		<th style="text-align: center;">Aksi</th>
	</thead>
	<tbody>
		<?php foreach ($kelompoktani->result() as $kel): ?>
			<tr>
				<td>
					<table width="40%">
						<tr>
							<td>Nama Kelompok Tani</td><td>:</td><td><?php echo $kel->nama_kelompok_tani ?></td>
						</tr>
						<tr>
							<td>Alamat</td><td>:</td><td><?php echo $kel->alamat ?></td>
						</tr>
						<tr>
							<td>No. Telp / No. HP</td><td>:</td><td><?php echo $kel->no_telp ?></td>
						</tr>
					</table>
				</td>

				<td align="center" style="width: 10%;vertical-align: middle;">
					<button type="button" 
						class="btn btn-primary btn-sm btn_pilih_penyandangdana" 
						id_kelompok_tani = "<?php echo $kel->id_kelompok_tani ?>"
						nama_kelompok_tani = "<?php echo $kel->nama_kelompok_tani ?>"
					>Pilih</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
        var mytable = $("#tbl_kelompoktani").DataTable({
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
	$(document).on("click",".btn_pilih_penyandangdana",function(){
      var id_kelompok_tani=$(this).attr('id_kelompok_tani');
      var nama_kelompok_tani=$(this).attr('nama_kelompok_tani');
  		$('#id_kelompok_tani').val(id_kelompok_tani);
  		$('#nama_kelompok_tani').val(nama_kelompok_tani);
  		$(".modal_cari-kelompoktani").modal("hide");
	})
</script>