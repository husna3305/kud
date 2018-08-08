<table class="table table-bordered table-striped table-condensed table-hover" id="tbl_penyandangdana">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">Nama Penyandang Dana</th>
		<th style="text-align: center;">Aksi</th>
	</thead>
	<tbody>
		<?php foreach ($penyandangdana->result() as $kel): ?>
			<tr>
				<td>
					<table width="40%">
						<tr>
							<td>Nama</td><td>:</td><td><?php echo $kel->nama_penyandangdana ?></td>
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
						class="btn btn-primary btn-sm btn_pilih_item" 
						id_penyandangdana = "<?php echo $kel->id_penyandangdana ?>"
						nama_penyandangdana = "<?php echo $kel->nama_penyandangdana ?>"
					>Pilih</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
        var mytable = $("#tbl_penyandangdana").DataTable({
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
	$(document).on("click",".btn_pilih_item",function(){
      var id_penyandangdana=$(this).attr('id_penyandangdana');
      var nama_penyandangdana=$(this).attr('nama_penyandangdana');
  		$('#id_penyandangdana').val(id_penyandangdana);
  		$('#nama_penyandangdana').val(nama_penyandangdana);
  		$(".modal_cari-penyandangdana").modal("hide");
	})
</script>