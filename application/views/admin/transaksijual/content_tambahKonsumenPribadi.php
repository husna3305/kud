<script src="<?php echo base_url('assets/plugins/jquery-input-count/js/jquery-input-char-count.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-input-count/css/jquery-input-char-count-bootstrap3.min.css'); ?>">
<?php echo form_open(current_url(), array('class' => 'form-horizontal form_tambah', 'id' => 'form_tambah', 'name' =>'form_tambah')); ?>
					<div class="box-body" style="padding-left:30px;">
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Nama Data Konsumen Pribadi</b> <br />
									<i style="font-size:12px;">Tulis nama kelompok tani yang akan ditambah</i>                
								</label>
								<div class="col-sm-5">
									<input type="text" name="nama_konsumenpribadi" id="nama_konsumenpribadi" value="<?php echo set_value('name') ?>" id="name" class="form-control input-char-count " maxlength="60"/>
									<label id="nama_konsumenpribadi_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan nama kelompok tani</label>
								</div>
							</div>
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">Alamat</b> <br />
									<i style="font-size:12px;">Tulis alamat kelompok tani yang akan ditambah</i>                
								</label>
								<div class="col-sm-8">
									<input type="text" name="alamat" id="alamat" value="" id="alamat" class="form-control input-char-count " maxlength="100"/>
									<label id="alamat_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan alamat kelompok tani</label>
								</div>
							</div>
							<div class="form-group" >
								<label for="name" class="col-sm-4 control-label" style="text-align:left">
									<b style="text-align:right;">No. Telp / No. HP</b> <br />
									<i style="font-size:12px;">Tulis nomor telepon atau nomor handphone kelompok tani yang akan ditambah</i>                
								</label>
								<div class="col-sm-3">
									<input type="text" name="no_telp" id="no_telp" value="" id="no_telp" class="form-control input-char-count " maxlength="16"/>
									<label id="no_telp_error" class="control-label" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan masukkan no. telepon atau no. hp kelompok tani</label>
								</div>
							</div>
					</div>
					<div class="box-footer" align="center">
						<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-primary', 'content' => '<i class="fa fa-save"></i>&nbsp;&nbsp;Simpan', 'id'=>'btn_submit', 'name' =>'btn_submit', 'value' => 'val')); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning', 'content' => '<i class="fa fa-undo-alt"></i>&nbsp;&nbsp;Reset')); ?> &nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn btn-default btn_dataKonsumenPribadi" type="button"><i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;Kembali</button>
					</div>
					</form>
<script type="text/javascript">
	$(document).on("click","#btn_submit",function(){
		 var form = $('#form_tambah');
		$.ajax( {
	      type: "POST",
	      url: form.attr( 'action' ),
	      data: form.serialize(),
	      success: function(html) {
	        $("#show_konsumenpribadi").html(html);
	      }
	    } );
	})
</script>