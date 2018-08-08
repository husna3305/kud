<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
	              <?php if($this->session->flashdata('true')){ ?>
	              	<div class="alert alert-success alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> Informasi</h4>
		                <?php  echo $this->session->flashdata('true'); ?> <?php } ?>
		            </div>
				  <?php if($this->session->flashdata('err')){ ?>
				  		<div class="alert alert-warning alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                <h4><i class="icon fa fa-exclamation"></i> Informasi</h4>
			                <?php  echo $this->session->flashdata('err'); ?>
			            </div>
				  <?php } ?>
				 <div class="box">
					<div class="box-header with-border">
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
						
						<?php echo form_open(site_url('admin/barang/aksi_masal'), array('class' => 'form-horizontal form_multi_select', 'id' => 'form_multi_select', 'name' =>'form_multi_select','method'=>'post')); ?>
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
                        <th style="text-align: center;">Uraian Barang Yang Dihapus</th>  
                        <?php $col = 2; if ($edited=='y' or $deleted=='y'): ?>
									<th style="text-align: center;">Aksi</th>
								<?php $col =4; endif ?>
                    </tr>
                </thead>

                <?php foreach( $barang_dihapus->result() as $brg ) { ?>
							<tr>
								<td style="text-align: center;vertical-align: middle;"><?php echo $brg->id_barang ?></td>
								<td>
									Nama Barang : <?php echo $brg->nama_barang ?> <br>
									Kategori : <?php echo $brg->nama_kategori ?>
								</td>
							<!--	<td align="center" width="10%"><?php echo $brg->order; ?></td> -->
								<?php if ($edited=='y' or $deleted=='y'): ?>
									<td align="center" style="width: 22%;vertical-align: middle;" >
									<?php if ($edited=='y'): ?>
										<button type="button" data-id_barang="<?php echo $brg->id_barang ?>" data-delete_status="<?php echo $brg->delete_status ?>" class="btn btn-success btn-xs set_delete"><i class="fa fa-check"></i>&nbsp;&nbsp;Batal Hapus</button>
									<?php endif ?>
									<?php if ($deleted=='y'): ?>
										&nbsp;&nbsp;
										<button type="button" data-id_barang="<?php echo $brg->id_barang ?>" class="btn btn-danger btn-xs delete_permanen"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Permanen</button>

									<?php endif ?>
									</td>
								<?php endif ?>
							</tr>
						<?php } ?>
						</tbody>
            </table>
        </form>
        <a href="<?php echo site_url('admin/barang') ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
			 </div>
		</div>
	</section>
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
			  	var id_barang = $(this).data('id_barang'); //get value input
			  	var delete_status = $(this).data('delete_status'); //get value input
			    $.ajax({
					 url:"<?php echo site_url('admin/barang/setDelete');?>",
					 type:"POST",
					 data:"id_barang="+id_barang+"&delete_status="+delete_status+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
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
			  	var id_barang = $(this).data('id_barang'); //get value input
			  	var delete_status = $(this).data('delete_status'); //get value input
			    $.ajax({
					 url:"<?php echo site_url('admin/barang/delete_permanen');?>",
					 type:"POST",
					 data:"id_barang="+id_barang+"&delete_status="+delete_status+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
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


/*
        $("#form_multi_select").on('submit', function(e){
        	e.preventDefault()
            var form = this
            var rowsel = mytable.column(0).checkboxes.selected();
            $.each(rowsel, function(index, rowId){
                $(form).append(
                    $('<input>').attr('type','text').attr('name','id[]').val(rowId)
                )
            })
          //  $("#view-rows").text(rowsel.join(","))
          //  $("#view-form").text($(form).serialize())
           // $('input[name="id\[\]"]', form).remove()
            //e.preventDefault()
			document.form_multi_select.action = "<?php site_url('admin/barang/aktif_all') ?>";
            document.getElementById('form_multi_select').submit();
        }) */
    })
    </script>