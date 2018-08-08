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
						<h3 class="box-title"><?php echo $pagetitle ?></h3>
					</div>
					<?php echo form_open(current_url(), array('class' => 'form-horizontal form_update', 'id' => 'form_update', 'name' =>'frm')); ?>
					<div class="box-body" style="padding-left:30px;">
							<input type="hidden" name="id_kelompok_tani" id="id_kelompok_tani" value="<?php echo $kelompoktani->id_kelompok_tani ?>">
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Nama Data Kelompok Tani</b> <br />
									<i style="font-size:12px;">Tulis nama kelompok tani yang akan diubah</i>                
								</label>
								<div class="col-sm-5">
									<input type="text" name="nama_kelompok_tani" id="nama_kelompok_tani" value="<?php echo $kelompoktani->nama_kelompok_tani ?>" class="form-control input-char-count " maxlength="60"/>
									<label id="nama_kelompok_tani_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan nama kelompok tani</label>
								</div>
							</div>
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Alamat</b> <br />
									<i style="font-size:12px;">Tulis alamat kelompok tani yang akan diubah</i>                
								</label>
								<div class="col-sm-8">
									<input type="text" name="alamat" id="alamat" id="alamat" class="form-control input-char-count " maxlength="100" value="<?php echo $kelompoktani->alamat ?>" />
									<label id="alamat_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan alamat kelompok tani</label>
								</div>
							</div>
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">No. Telp / No. HP</b> <br />
									<i style="font-size:12px;">Tulis nomor telepon atau nomor handphone kelompok tani yang akan diubah</i>                
								</label>
								<div class="col-sm-2">
									<input type="text" name="no_telp" id="no_telp" id="no_telp" class="form-control input-char-count " maxlength="15" value="<?php echo $kelompoktani->no_telp ?>" />
									<label id="no_telp_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan no. telepon atau no. hp kelompok tani</label>
								</div>
							</div>
							<div class="form-group">
								<label for="aktif" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Status Aktif Kelompok Tani</b> <br />
									<i style="font-size:12px;">Aktifkan jika kelompok tani yang akan dibuat memiliki status aktif</i>                          
								</label>
								<div class="col-sm-8">
									<input type="checkbox" id="aktif" name="aktif" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak" <?php if ($kelompoktani->aktif==1): ?>
										checked
									<?php endif ?>>
								</div>
							</div>
					</div>
					<div class="box-footer" align="center">
						<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-primary', 'content' => '<i class="fa fa-save"></i>&nbsp;&nbsp;Simpan', 'id'=>'btn_submit', 'name' =>'btn_submit', 'value' => 'val')); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning', 'content' => '<i class="fa fa-undo-alt"></i>&nbsp;&nbsp;Reset')); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo anchor('admin/kelompoktani', '<i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;Batal', array('class' => 'btn btn-default')); ?>
					</div>
					</form>
				</div>
			 </div>
		</div>
	</section>
</div>

<script type="text/javascript">

    $( "#nama_kelompok_tani" ).bind( "change keyup", function() {
    	$("#nama_kelompok_tani").removeClass("has-input-error");nama_kelompok_tani_error.style.display = 'none';
    });

$(document).ready(function(){
    // Submit Data
	    $('#btn_submit').click(function(){
	    
	    	// Cek Inputan Data
	    	var nama_kelompok_tani = $('#nama_kelompok_tani').val();

	    	if (!nama_kelompok_tani) {
	    		$("html, body").animate({ scrollTop: 0 }, "fast");$("#nama_kelompok_tani").addClass("has-input-error");nama_kelompok_tani_error.style.display = 'block';
	    	}else{
	    		$("#nama_kelompok_tani").removeClass("has-input-error");nama_kelompok_tani_error.style.display = 'none';
	    	}

			if (!!nama_kelompok_tani) {
	    		 document.getElementById('form_update').submit();
			}
	    	// End Of Cek Inputan Data
	    });
    });
    // End Of Submit Data
</script>