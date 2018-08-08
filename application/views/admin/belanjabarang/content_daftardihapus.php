<div class="tab-pane active" id="tab_admin">
								<div class="box-body">
									 <div class="box">
					<div class="box-header with-border">
						<h4 style="text-align: center;">Data Transaksi Belanja Barang Yang Dihapus </h4>
						<?php foreach ($menu_id as $mi): ?>
							<?php 
								//Check Access Inserted Data
								foreach ($menu_id as $menu) {
									
									if ($menu->inserted==1) {
										$inserted='y';
										break;
									}else{
										$inserted='n';
									}
								}
								//Check Access Edited Data
								foreach ($menu_id as $menu) {
									if ($menu->edited==1) {
										$edited='y';
										break;
									}else{
										$edited='n';
									}
								}
								//Check Access Deleted Data
								foreach ($menu_id as $menu) {
									if ($menu->deleted==1) {
										$deleted='y';
										break;
									}else{
										$deleted='n';
									}
								}
							?>
						<?php endforeach ?>
						
						<?php echo form_open(site_url('admin/belanjabarang/aksi_masal'), array('class' => 'form-horizontal form_multi_select', 'id' => 'form_multi_select', 'name' =>'form_multi_select','method'=>'post')); ?>
						<div class="row">
							<div class="col-md-6">
								<div class="btn-group">
				                  <button type="button" class="btn btn-info">Aksi Masal</button>
				                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
				                    <span class="caret"></span>
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                 <ul class="dropdown-menu" role="menu">
				                    <li><a href="#" aksi="batal_hapus" class="btn_aksi_masal"><i class="fa fa-check"></i>Batal Hapus</a></li>
				                    <li><a href="#" aksi="hapus_permanen" class="btn_aksi_masal"><i class="fa fa-trash"></i>Hapus Permanen</a></li>
				                  </ul>
				                </div>
							</div>
							
						</div>
					</div>

					<div class="box-body">
            <table id="data_table" class="table table-bordered table-striped table-hover">
                <thead style="font-weight: bold;font-size: 16px;background-color: #5ca1c7;color: white;">
                    <tr>    
                        <th style="text-align: center;" width="2%"></th>  
                        <th style="text-align: center;">ID Transaksi</th>  
                        <th style="text-align: center;">Tanggal dan Waktu</th>  
                        <th style="text-align: center;">Total Pembayaran</th>  
                        <th style="text-align: center;">Suplier</th>  
                        <th style="text-align: center;">Petugas</th>  
                        <?php $col = 3; if ($edited=='y' or $deleted=='y'): ?>
									<th style="text-align: center;">Aksi</th>
								<?php $col =4; endif ?>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach ($transaksi_header as $th): ?>
                		<tr>
                			<td><?php echo $th->id ?></td>
                			<td><?php echo $th->id_transaksi_belanja ?></td>
                			<td><?php echo shortdate_indo($th->tanggal) ?>, <?php echo $th->waktu ?></td>
                			<td>Rp. <?php echo $this->cart->format_number($th->total_pembayaran) ?></td>
                			<td><?php echo $th->nama_suplier ?></td>
                			<td><?php echo $th->first_name ?> <?php echo $th->last_name ?></td>
                			<?php if ($edited=='y' or $deleted=='y'): ?>
									<td align="center" style="width: 22%;vertical-align: middle;" >
									<?php if ($edited=='y'): ?>
										<button type="button" data-id="<?php echo $th->id ?>" data-deleted_status="<?php echo $th->deleted_status ?>" class="btn btn-success btn-xs set_delete"><i class="fa fa-check"></i>&nbsp;&nbsp;Batal Hapus</button>
									<?php endif ?>
									<?php if ($deleted=='y'): ?>
										&nbsp;&nbsp;
										<button type="button" data-id="<?php echo $th->id ?>" class="btn btn-danger btn-xs delete_permanen"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Permanen</button>

									<?php endif ?>
									</td>
								<?php endif ?>
                		</tr>
                	<?php endforeach ?>
                </tbody>
            </table>

        </form>
        <a href="<?php echo site_url('admin/belanjabarang/daftartransaksi') ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;Kembali</a>
					</div>
								</div>
						</div>
					</div>
				</div>	

<script type="text/javascript">

	$('#data_table').on('click','.set_delete',function(){
		swal({
			  title: 'Apakah anda Batal Menghapus Data Ini ?',
			  text: "",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya',
			  cancelButtonText: 'Batal',
			  confirmButtonClass: 'btn btn-success',
			  cancelButtonClass: 'btn btn-danger',
			  buttonsStyling: false,
			  reverseButtons: false
			}).then((result) => {
			  if (result.value) {
			  	var id = $(this).data('id'); //get value input
			  	var deleted_status = $(this).data('deleted_status'); //get value input
			    $.ajax({
					 url:"<?php echo site_url('admin/belanjabarang/setDelete');?>",
					 type:"POST",
					 data:"id="+id+"&deleted_status="+deleted_status+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
					 cache:false,
					 success:function(html){
						window.location.reload(true);
					 }
				})
			  }
			}); //End Of Swal
	}); //End Of #data_table .set_delete

	$('#data_table').on('click','.delete_permanen',function(){
		swal({
			  title: 'Apakah Yakin Menghapus Data Ini Secara Permanen ?',
			  text: "",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya',
			  cancelButtonText: 'Batal',
			  confirmButtonClass: 'btn btn-success',
			  cancelButtonClass: 'btn btn-danger',
			  buttonsStyling: false,
			  reverseButtons: false
			}).then((result) => {
			  if (result.value) {
			  	var id = $(this).data('id'); //get value input
			  	var deleted_status = $(this).data('deleted_status'); //get value input
			    $.ajax({
					 url:"<?php echo site_url('admin/belanjabarang/delete_permanen');?>",
					 type:"POST",
					 data:"id="+id+"&deleted_status="+deleted_status+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
					 cache:false,
					 success:function(html){
						window.location.reload(true);
					 }
				})
			  }
			}); //End Of Swal
	}); //End Of #data_table .set_delete

</script>



<script>
    $(document).ready(function(){
        var mytable = $("#data_table").DataTable({
            columnDefs: [
                {
                    targets: 0,
                    checkboxes: {
                        selectRow: false
                    }
                }
            ],
            select:{
                style: 'multi'
            },
            order: [[1, 'asc']]
        })


        $(document).on("click",".btn_aksi_masal",function(e){
	      var aksi=$(this).attr('aksi');
	      e.preventDefault()
            var rowsel = mytable.column(0).checkboxes.selected();
            $.each(rowsel, function(index, rowId){
                $('#form_multi_select').append(
                    $('<input>').attr('type','hidden').attr('name','id[]').val(rowId),
                    $('<input>').attr('type','hidden').attr('name','status_aksi').val(aksi)
                )
            })
          //  $("#view-rows").text(rowsel.join(","))
          //  $("#view-form").text($(form).serialize())
           // $('input[name="id\[\]"]', form).remove()
            //e.preventDefault()
            document.form_multi_select.submit();

		})
    })
    </script>