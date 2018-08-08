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
						<h3 class="box-title">Form Tambah Kategori Barang</h3>
					</div>
					<?php echo form_open(current_url(), array('class' => 'form-horizontal form_tambah_kategori', 'id' => 'form_tambah_kategori', 'name' =>'frm')); ?>
					<div class="box-body" style="padding-left:30px;">
						
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Nama Kategori Barang</b> <br />
									<i style="font-size:12px;">Tulis nama kategori barang yang akan ditambah</i>                
								</label>
								<div class="col-sm-4">
									<input type="text" name="nama_kategori_baru" id="nama_kategori_baru" value="<?php echo set_value('name') ?>" id="name" class="form-control input-char-count " maxlength="40"/>
									<label id="nama_kategori_baru_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan nama kategori</label>
								</div>
							</div>
							
							<div class="form-group">
								<label for="check_parent_id" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Kategori Utama</b> <br />
									<i style="font-size:12px;">Aktifkan jika kategori yang akan dibuat merupakan kategori utama</i>                          
								</label>
								<div class="col-sm-8">
									<input type="checkbox" id="check_parent_id" name="check_parent_id" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak" onchange="do_check_parent_id(this)">
								</div>
							</div>
							
							<div id="parent_id_select">
								<div class="form-group">
									<label for="link" class="col-sm-4 control-label" style="text-align:left">
										<b style="text-align:right;">Pilih Kategori Utama</b> <br />
										<i style="font-size:12px;">Pilih kategori utama jika kategori barang yang akan ditambahkan merupakan sub dari kategori utama</i>                          
									</label>
									<div class="col-sm-4" >
										<input type="text" name="nama_kategori" class="form-control" readonly="" id="nama_kategori">
										<label id="nama_kategori_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan pilih kategori utama</label>
										<input type="hidden" name="parent_id" id="id_kategori">
									</div>

									<div class="col-sm-2">
										<button type="button" class="btn btn-primary" data-count_search="'+count_combine+'" data-toggle="modal" data-target=".modal_cari-kategori"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="aktif" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Status Aktif Kategori Barang</b> <br />
									<i style="font-size:12px;">Aktifkan jika kategori barang yang akan dibuat memiliki status aktif</i>                          
								</label>
								<div class="col-sm-8">
									<input type="checkbox" id="aktif" name="aktif" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak" checked>
								</div>
							</div>
					</div>
					<div class="box-footer" align="center">
						<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-primary', 'content' => 'Simpan', 'id'=>'btn_submit', 'name' =>'btn_submit', 'value' => 'val')); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning', 'content' => lang('actions_reset'))); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo anchor('admin/kategori', 'Batal', array('class' => 'btn btn-default')); ?>
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
      <div class="modal-body" id="show_root_kategori">
      </div>
      <div class="modal-footer">
    	   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Cari Kategori -->


<script type="text/javascript">
	// Fungsi Cek Status Kategori Utama
	function do_check_parent_id(checkboxElem) {
	  if (checkboxElem.checked) {
	      parent_id_select.style.display = 'none';
	      $('#nama_kategori').val('');
	      $('#id_kategori').val('');
	  } else {
	    parent_id_select.style.display = 'block';
	  }
	}
	// Fungsi Cek Status Kategori Utama

	// Load Modal Cari Kategori
    $('.modal_cari-kategori').on('show.bs.modal', function(e) {
    $("#nama_kategori").removeClass("has-input-error");nama_kategori_error.style.display = 'none';
       var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
       var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
           $.ajax({
               url:"<?php echo site_url('admin/kategori/search_root_kategori');?>",
               type:"POST",
               data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
               cache:false,
               success:function(html){
                  $("#show_root_kategori").html(html);
               }
          })
    });
    // End Of Load Modal Cari Kategori
    $( "#nama_kategori_baru" ).bind( "change keyup", function() {
    	$("#nama_kategori_baru").removeClass("has-input-error");nama_kategori_baru_error.style.display = 'none';
    });

$(document).ready(function(){
    // Submit Data
	    $('#btn_submit').click(function(){
	    
	    	// Cek Inputan Data
	    	var nama_kategori_baru = $('#nama_kategori_baru').val();
	    	var nama_root_kategori = $('#nama_kategori').val();

	    	if (!nama_kategori_baru) {
	    		$("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_kategori_baru").addClass("has-input-error");nama_kategori_baru_error.style.display = 'block';
	    	}else{
	    		$("#nama_kategori_baru").removeClass("has-input-error");nama_kategori_baru_error.style.display = 'none';
	    	}

	    	var cek_root_kategori = 0;
	    	if ($('#check_parent_id').prop('checked')==false) {
			     if (!nama_root_kategori) {
			     	$("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_kategori").addClass("has-input-error");nama_kategori_error.style.display = 'block';
			     }else{
			     	 cek_root_kategori = 1;
			     	 $("#nama_kategori").removeClass("has-input-error");nama_kategori_error.style.display = 'none';
			     }
			}else{
				cek_root_kategori = 1;
			}
			if (!!nama_kategori_baru & cek_root_kategori == 1) {
	    		 document.getElementById('form_tambah_kategori').submit();
			}
	    	// End Of Cek Inputan Data
	    });
    });
    // End Of Submit Data
</script>