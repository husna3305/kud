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
					<?php $this->load->view('admin/belanjabarang/menus') ?>					
					<div class="tab-content" id="show_daftartransaksi">
						<div class="tab-pane active" id="tab_admin">
								<div class="box-body">
									 <div class="box box-">
					<div class="box-header with-border">
						<div class="row">
						<h4 style="text-align: center;">Daftar Transaksi Belanja Berdasarkan Barang</h4>
							
						</div>
					</div>

					<div class="box-body">
            <table id="data_table" class="table table-bordered table-striped table-hover">
                <thead style="font-weight: bold;font-size: 16px;background-color: #5ca1c7;color: white;">
                    <tr>      
                        <th style="text-align: center; width: 4%">No.</th>  
                        <th style="text-align: center;">Nama Barang</th>  
                        <th style="text-align: center; width: 17%">Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                	<?php $no=1; foreach ($bybarang as $by_brg): ?>
                		<tr>
                			<td style="text-align: center;"><?php echo $no ?>.</td>
                			<td><a href="<?php echo site_url('admin/belanjabarang/bybarangdetail/'.$by_brg->barang) ?>"><?php echo $by_brg->nama_barang ?></a></td>
                			<td align="center"><?php echo $this->cart->format_number($by_brg->jml_transaksi) ?></td>
                		</tr>
                	<?php $no++; endforeach ?>
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

	
  $('.btn_showhapus').click(function(e){
  	e.preventDefault();
	 $.ajax({
             url:"<?php echo site_url('admin/belanjabarang/deletedtransaksi');?>",
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
                }
            ],
            order: [[0, 'asc']],
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
    })
    </script>