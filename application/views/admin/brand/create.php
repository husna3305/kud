<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script>
  $(function () {
	//bootstrap WYSIHTML5 - text editor
	$('.textarea').wysihtml5()
  })
</script>

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
									<h3 class="box-title">Form Brand Baru</h3>
								</div>
								<div class="box-body" style="padding-left:30px;">
									<?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
										<div class="form-group " >
											<label for="name" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Nama Brand</b> <br />
												<i style="font-size:12px;">Tulis nama brand baru</i>
											</label>
											<div class="col-sm-3 ">
												<input type="text" name="name" value="<?php echo set_value('name') ?>" id="name" class="form-control"/>
											</div>
											<div class="col-sm-6">
												<?php if (validation_errors()) { ?>
												<i style="color:red;margin-bottom:0px;"><?php echo form_error('name') ?></i>
												<?php } ?>
											</div>
										</div>

										<div class="form-group">
											<label for="link" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Deskripsi Brand Baru</b> <br />
												<i style="font-size:12px;">Tulis Deskripsi Brand Baru</i>
											</label>
											<div class="col-sm-7 " >
												<textarea class="textarea" name="description" placeholder="Place some text here"
						  						style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo set_value('description') ?></textarea>
											</div>
											<div class="col-sm-2">
												<?php if (validation_errors()) { ?>
												<i style="color:red;margin-bottom:0px;"><?php echo form_error('description') ?></i>
												<?php } ?>
											</div>
										</div>
                    <div class="form-group">
											<label for="" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Upload Logo</b> <br />
												<i style="font-size:12px;">Upload logo untuk brand.(Format file JPG, JPEG, PNG, dan BMP. Maksimal 5 MB)</i>
											</label>
											<div class="col-sm-5">
                        <div class="form-group">
                            <div id="image_preview"><img id="previewing" src="<?php echo base_url('upload/brand/noimage.png'); ?>" width="150px"/></br></br></div>
                      <!--
                		  <button type="button" class="btn btn-primary" onclick="addNew()">Add new ImagerJs</button>
                		</div>
                		<div class="form-group" id="imagers"> !-->
	                		       <input class="btn btn-primary" type="file" name="file_brand" id="file" required />
                		  </div>
											</div>
											<div class="col-sm-4">
												<?php if (validation_errors()) { ?>
												<i style="color:red;margin-bottom:0px;"><?php echo form_error('order') ?></i>
												<?php } ?>
											</div>
										</div>
										<div class="form-group">
											<label for="order" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Posisi Brand</b> <br />
												<i style="font-size:12px;">Tentukan posisi untuk brand yang akan dibuat</i>
											</label>
											<div class="col-sm-2">
												<input type="text" name="order" value="<?php echo set_value('order') ?>" id="order" class="form-control"/>
											</div>
											<div class="col-sm-4">
												<?php if (validation_errors()) { ?>
												<i style="color:red;margin-bottom:0px;"><?php echo form_error('order') ?></i>
												<?php } ?>
											</div>
										</div>

										<div class="form-group">
											<label for="active" class="col-sm-3 control-label" style="text-align:left">
												<b style="text-align:right;">Status Aktif Brand</b> <br />
												<i style="font-size:12px;">Aktifkan jika brand yang akan dibuat memiliki status aktif</i>
											</label>
											<div class="col-sm-9">
												<input type="checkbox" id="active" name="active" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-9">
												<div class="btn-group">
													<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
													<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
													<?php echo anchor('admin/brand', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
												</div>
											</div>
										</div>
									<?php echo form_close();?>
								</div>
							</div>
						 </div>
					</div>
				</section>
			</div>
<script type="text/javascript">
$(document).ready(function (e) {
  $("#uploadimage").on('submit',(function(e) {
    e.preventDefault();
    $("#message").empty();
    $('#loading').show();
    $.ajax({
          url: "ajax/ajax_php_file.php",   	// Url to which the request is send
      type: "POST",      				// Type of request to be send, called as method
      data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values
      contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
          cache: false,					// To unable request pages to be cached
      processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
      success: function(data)  		// A function to be called if request succeeds
        {
      $('#loading').hide();
      $("#message").html(data);
        }
     });
  }));

// Function to preview image
  $(function() {
        $("#file").change(function() {
      $("#message").empty();         // To remove the previous error message
      var file = this.files[0];
      var imagefile = file.type;
      var imagesize = file.size;
      if (imagesize > 5242880) {
        alert('Gambar Melebihi Ukuran Yang Ditentukan');
        return  false;
      }
      var match= ["image/jpeg","image/png","image/jpg"];
      if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
      {
      $('#previewing').attr('src','noimage.png');
      $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
      return false;
      }
            else
      {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
  function imageIsLoaded(e) {
    $("#file").css("color","green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '150px');
  };
});

</script>
