<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<style media="screen">
  .has-input-error{
    border-color: #a94442;
  }
</style>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				 <div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Form Update Data Suplier</h3>
					</div>
					<?php echo form_open(current_url(), array('class' => 'form-horizontal form_update', 'id' => 'form_update', 'name' =>'frm')); ?>
					<input type="hidden" name="id_" value="<?php echo $barang->id_ ?>">
					<div class="box-body" style="padding-left:30px;">
						
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Nama Data Barang</b> <br />
									<i style="font-size:12px;">Tulis nama barang barang yang akan diubah</i>                
								</label>
								<div class="col-sm-4">
									<input type="text" name="nama_barang" id="nama_barang" value="<?php echo $barang->nama_barang ?>" id="name" class="form-control input-char-count " maxlength="40"/>
									<label id="nama_barang_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan nama barang</label>
								</div>
							</div>
							<div class="form-group">
								<label for="link" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Pilih Kategori Barag</b> <br />
									<i style="font-size:12px;">Pilih kategori untuk barang yang akan diubah</i>                          
								</label>
								<div class="col-sm-4" >
									<input type="text" name="nama_kategori" class="form-control" readonly id="nama_kategori" value="<?php echo $barang->nama_kategori ?>">
									<label id="nama_kategori_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan pilih kategori</label>
									<input type="hidden" name="id_kategori" id="id_kategori" value="<?php echo $barang->id_kategori ?>">
								</div>

								<div class="col-sm-2">
									<button type="button" class="btn btn-primary" data-count_search="'+count_combine+'" data-toggle="modal" data-target=".modal_cari-kategori"><i class="fa fa-search"></i></button>
								</div>
							</div>
							<div class="form-group">
								<label for="aktif" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Status Aktif Kategori Barang</b> <br />
									<i style="font-size:12px;">Aktifkan jika barang yang akan dibuat memiliki status aktif</i>                          
								</label>
								<div class="col-sm-8">
									<input type="checkbox" id="aktif" name="aktif" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak" <?php if ($barang->aktif==1): ?>
										checked
									<?php endif ?>>
								</div>
							</div>
					</div>
					<div class="box-footer" align="center">
						<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-primary', 'content' => '<i class="fa fa-save"></i>&nbsp;&nbsp;Simpan', 'id'=>'btn_submit', 'name' =>'btn_submit', 'value' => 'val')); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning', 'content' => '<i class="fa fa-undo-alt"></i>&nbsp;&nbsp;Reset')); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo anchor('admin/barang', '<i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;Batal', array('class' => 'btn btn-default')); ?>
					</div>
					</form>
				</div>
			 </div>
		</div>
	</section>
</div>

<!-- Modal Cari Kategori -->
<div class="modal fade modal_cari-kategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    	   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	   <span aria-hidden="true">&times;</span></button>
    	   <h4 class="modal-title">Data Kategori Barang</h4>
      </div>
      <div class="modal-body" id="show_kategori">
      </div>
      <div class="modal-footer">
    	   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Kategori -->


<script type="text/javascript">

	// Load Modal Cari Kategori
    $('.modal_cari-kategori').on('show.bs.modal', function(e) {
    $("#nama_barang").removeClass("has-input-error");nama_barang_error.style.display = 'none';
       var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
       var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
           $.ajax({
               url:"<?php echo site_url('admin/barang/search_kategori');?>",
               type:"POST",
               data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#show_kategori").html(html);
               }
          })
    });

    // End Of Load Modal Cari Kategori
    $( "#nama_barang" ).bind( "change keyup", function() {
    	$("#nama_barang").removeClass("has-input-error");nama_barang_error.style.display = 'none';
    });

    // Submit Data
	    $('#btn_submit').click(function(){
	    
	    	// Cek Inputan Data
	    	var nama_barang = $('#nama_barang').val();
	    	var nama_kategori = $('#nama_kategori').val();
	    	var id_kategori = $('#id_kategori').val();

	    	if (!nama_barang) {
	    		$("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_barang").addClass("has-input-error");nama_barang_error.style.display = 'block';
	    	}else{
	    		$("#nama_barang").removeClass("has-input-error");nama_barang_error.style.display = 'none';
	    	}
			if (!!nama_barang & !!nama_kategori & !!id_kategori) {
	    		 document.getElementById('form_update').submit();
			}
	    	// End Of Cek Inputan Data
	    });
</script>