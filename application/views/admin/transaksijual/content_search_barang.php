<table class="table table-bordered table-striped table-condensed table-hover" id="data_table">
	<thead style="background-color: #87c6ea;color: white;text-align: center;"> 
		<th style="text-align: center;">No.</th>
		<th style="text-align: center;">Data Barang</th>
		<th style="text-align: center;">Stok Barang</th>
	</thead>
	<tbody>
		<?php $no=1;foreach ($barang->result() as $brg): ?>
			<button class="btn btn-link">
			<tr>
				<td style="width:3%;text-align: center;"><?php echo $no ?>.</td>
				<td class="filterable-cell">
					<a href="#" class="btn_barang" id_barang="<?php echo $brg->id_barang ?>">
						Nama Barang : <?php echo $brg->nama_barang ?> <br>
						Kategori : <?php if($brg->root_kategori<>null){?> <?php echo $brg->root_kategori ?>,&nbsp;<?php } ?><?php echo $brg->nama_kategori ?>
					</a>
				</td>
				<?php $stok = $brg->masuk - $brg->keluar ?>
				<td class="filterable-cell" style="text-align: center;"><?php echo $this->cart->format_number($stok); ?></td>
			</tr>
		</button>
		<?php $no++; endforeach ?>
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
            
            order: [[0, 'asc']],
            "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         true
        });

    });
	$(document).on("click",".btn_barang",function(){
		event.preventDefault();
      var id_barang=$(this).attr('id_barang');
      $.ajax({
               url:"<?php echo site_url('admin/transaksijual/search_stokbarang');?>",
               type:"POST",
               data:"id_barang="+id_barang
                    +"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#show_barang").html(html);
               }
          });
	})
</script>