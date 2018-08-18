<div class="with-border" style="text-align: right;">
        <button class="btn btn-primary btn_tambah_konsumenpribadi"><i class="fa fa-plus"></i>&nbsp;&nbsp; Tambah</button>
      </div><br>
<table class="table table-bordered table-striped table-condensed table-hover" id="tbl_konsumenpribadi">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">Nama</th>
		<th style="text-align: center;">Aksi</th>
	</thead>
	<tbody>
		<?php foreach ($konsumenpribadi->result() as $kel): ?>
			<tr>
				<td>
					<table width="40%">
						<tr>
							<td>Nama</td><td>:</td><td><?php echo $kel->nama_konsumenpribadi ?></td>
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
						id_konsumenpribadi = "<?php echo $kel->id_konsumenpribadi ?>"
						nama_konsumenpribadi = "<?php echo $kel->nama_konsumenpribadi ?>"
					>Pilih</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
        var mytable = $("#tbl_konsumenpribadi").DataTable({
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
      var id_konsumenpribadi=$(this).attr('id_konsumenpribadi');
      var nama_konsumenpribadi=$(this).attr('nama_konsumenpribadi');
  		$('#id_konsumenpribadi').val(id_konsumenpribadi);
  		$('#nama_konsumenpribadi').val(nama_konsumenpribadi);
  		$(".modal_cari-konsumenpribadi").modal("hide");
	})

	$(document).on("click",".btn_pilih_item",function(){

	})
</script>