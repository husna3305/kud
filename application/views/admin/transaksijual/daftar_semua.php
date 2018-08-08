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
			 <div class="box" >
				<div class="nav-tabs-custom">
					<?php $this->load->view('admin/transaksijual/menus') ?>					
					<div class="tab-content" id="show_daftartransaksi">
						<div class="tab-pane active" id="tab_admin">
								<div class="box-body">
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
						
						<?php echo form_open(site_url('admin/transaksijual/aksi_masal'), array('class' => 'form-horizontal form_multi_select', 'id' => 'form_multi_select', 'name' =>'form_multi_select','method'=>'post')); ?>
						<div class="row">
							<div class="col-md-6">
								<div class="btn-group">
				                  <button type="button" class="btn btn-info">Aksi Masal</button>
				                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
				                    <span class="caret"></span>
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <ul class="dropdown-menu" role="menu">
				                    <li><a href="#" aksi="hapus" class="btn_aksi_masal"><i class="fa fa-trash"></i>Hapus Yang Dipilih</a></li>
				                  </ul>
				                </div>
				                <div class="btn-group" style="margin-left: 10px">
				                	<a href="" class="btn btn-block btn-danger btn_showhapus"><i class="fa fa-trash"></i>&nbsp;&nbsp;Data Dihapus</a>
				                </div>
							</div>
							<div class="col-md-6" style="text-align: right;">
									<?php if ($inserted=='y'): ?>
									<h3 class="box-title"><?php echo anchor('admin/transaksijual', '<i class="fa fa-plus"></i> &nbsp;&nbsp;Tambah', array('class' => 'btn btn-block btn-primary btn-')); ?></h3>
								<?php endif ?>
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
                        <th style="text-align: center;">Jenis Pembayaran</th>    
                        <th style="text-align: center;">Total Pembayaran</th>  
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
                			<td><a href="<?php echo site_url('admin/transaksijual/sukses/'.$th->id_transaksi_penjualan) ?>"><?php echo $th->id_transaksi_penjualan ?></a></td>
                			<td><?php echo shortdate_indo($th->tanggal) ?>, <?php echo $th->waktu ?></td>
                			<td><?php echo ucwords($th->jenis_pembayaran) ?></td>
                			<td>
                				Rp. <?php if ($th->jenis_pembayaran =='tunai') {
                				echo $this->cart->format_number($th->total_pembayaran_tunai);
                				}else{
                					echo $this->cart->format_number($th->total_pembayaran_angsur);
                				} ?>
                					
                			</td>

                			<td><?php echo $th->first_name ?> <?php echo $th->last_name ?></td>
                			<?php if ($edited=='y' or $deleted=='y'): ?>
									<td align="center" style="width: 10%;vertical-align: middle;">
									<?php if ($edited=='y'): ?>
										<?php echo anchor('admin/barang/update/'.$th->id, '<i class="fa fa-edit"></i> ', array('class' => 'btn btn-warning btn-xs')); ?>
									<?php endif ?>
									<?php if ($deleted=='y'): ?>
										&nbsp;&nbsp;
										<button type="button" data-id="<?php echo $th->id ?>" data-deleted_status="<?php echo $th->deleted_status ?>" class="btn btn-danger btn-xs set_delete"><i class="fa fa-trash"></i></button>

									<?php endif ?>
									</td>
								<?php endif ?>
                		</tr>
                	<?php endforeach ?>
                </tbody>
            </table>

        </form>
					</div>
								</div>
						</div>
					</div>
				</div>	

			</div>
		 </div>
	</div>
</section>
</div>

<script type="text/javascript">
	$('#data_table').on('click','.set_status',function(){
		swal({
			  title: 'Apakah Anda Yakin Ingin Mengubah Status Produk Yang Anda Pilih ?',
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
			  	var aktif = $(this).data('aktif'); //get value input
			    $.ajax({
					 url:"<?php echo site_url('admin/barang/setStatus');?>",
					 type:"POST",
					 data:"id="+id+"&aktif="+aktif+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
					 cache:false,
					 success:function(html){
						window.location.reload(true);
					 }
				})
			  }
			}); //End Of Swal
	}); //End Of #data_table .set_status

	$('#data_table').on('click','.set_delete',function(){
		swal({
			  title: 'Apakah Anda Yakin Ingin Menghapus Transaksi Ini ?',
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
					 url:"<?php echo site_url('admin/transaksijual/setDelete');?>",
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

	
  $('.btn_showhapus').click(function(e){
  	e.preventDefault();
	 $.ajax({
             url:"<?php echo site_url('admin/transaksijual/deletedtransaksi');?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#show_daftartransaksi").html(html);
             }
        });
  })
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
            order: [[1, 'desc']],
            "scrollY":        "450px",
        "scrollCollapse": true,
        "paging":         true
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
                //Date picker
                var datepicker_end = $('#datepicker_end').val();
    $('.datepicker_end').datepicker({
      autoclose: true,
      format:'yyyy-mm-dd',
      endDate: '+0d',
      startDate: datepicker_end,
    })
    })
    </script>