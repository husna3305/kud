<?php if ($barang->num_rows()>0): ?>
	<?php $brg_one=$barang->row() ?>
<table style="width: 30%;font-size: 16px" class="table table-condensed">
	<tr>
		<td>Nama Barang</td><td>:</td><td><?php echo $brg_one->nama_barang ?></td>
	</tr>
	<tr>
		<td>Kategori</td><td>:</td><td><?php if($brg_one->root_kategori<>null){?> <?php echo $brg_one->root_kategori ?>,&nbsp;<?php } ?><?php echo $brg_one->nama_kategori ?></td>
	</tr>
</table>
<?php endif ?>
<hr>
<table class="table table-bordered table-striped table-condensed table-hover" id="data_table"">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">Kode Transaksi Belanja Barang</th>
		<th style="text-align: center;">Harga Beli</th>
		<th style="text-align: center;">Harga Jual Satuan</th>
		<th style="text-align: center;">Harga Jual Angsuran</th>
		<th style="text-align: center;">Stok Tersedia</th>
		<th style="text-align: center;">Aksi</th>
	</thead>
	<tbody>
		<?php foreach ($barang->result() as $brg): ?>
			<tr>
				<td class="filterable-cell" style="text-align: center;"><?php echo $brg->keterangan_transaksi?></td>
				<td class="filterable-cell" style="text-align: center;">Rp. <?php echo $this->cart->format_number($brg->harga_beli) ?></td>
				<td class="filterable-cell" style="text-align: center;">Rp. <?php echo $this->cart->format_number($brg->harga_jual_tunai) ?></td>
				<td class="filterable-cell"  style="text-align: center;">Rp. <?php echo $this->cart->format_number($brg->harga_jual_angsur) ?></td>
				<?php $stok = $brg->masuk - $brg->barang_keluar ?>
				<td class="filterable-cell" style="text-align: center;"><?php echo $this->cart->format_number($stok) ?></td>
				<td align="center" style="width: 10%;vertical-align: middle;text-align: center;">
					<button type="button" 
						class="btn btn-primary btn-sm btn_pilih_record filterable-cell" 
						id_stok = "<?php echo $brg->id_stok ?>"
						stok = "<?php echo $stok ?>"
						id_barang = "<?php echo $brg->id_barang ?>"
						nama_barang = "<?php echo $brg->nama_barang ?>"
						harga_jual_tunai = "<?php echo $this->cart->format_number($brg->harga_jual_tunai) ?>"
						stok_tampil = "<?php echo $this->cart->format_number($stok) ?>"
						harga_jual_angsur = "<?php echo $this->cart->format_number($brg->harga_jual_angsur) ?>"
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
            
            order: [[0, 'desc']],
            "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         true
        });

    });
	$(document).on("click",".btn_pilih_record",function(){
      var id_stok=$(this).attr('id_stok');
      var id_barang=$(this).attr('id_barang');
      var nama_barang=$(this).attr('nama_barang');
      var harga_jual_tunai=$(this).attr('harga_jual_tunai');
      var harga_jual_angsur=$(this).attr('harga_jual_angsur');
      var stok=$(this).attr('stok');
      var stok_tampil=$(this).attr('stok_tampil');
 
  		$('#id_stok').val(id_stok);
  		$('#stok').val(stok);
  		$('#stok_tampil').val(stok_tampil);
  		$('#nama_barang').val(nama_barang);
  		$('#id_barang').val(id_barang);
  		$('#harga_jual_angsur').val(harga_jual_angsur);
  		$('#harga_jual_tunai').val(harga_jual_tunai);
  		$(".modal_cari-barang").modal("hide");
	})
</script>