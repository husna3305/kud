  <?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
  	<!-- Generic page styles -->
          	<link rel="stylesheet" href="<?= site_url('assets/plugins/jquery-upload/css/style.css'); ?>">
  	<!-- blueimp Gallery styles -->
  	<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
  	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  	<link rel="stylesheet" href="<?= site_url('assets/plugins/jquery-upload/css/jquery.fileupload.css'); ?>">
  	<link rel="stylesheet" href="<?= site_url('assets/plugins/jquery-upload/css/jquery.fileupload-ui.css'); ?>">
  	<!-- CSS adjustments for browsers with JavaScript disabled -->
  	<noscript><link rel="stylesheet" href="<?= site_url('assets/plugins/jquery-upload/css/jquery.fileupload-noscript.css'); ?>"></noscript>
  	<noscript><link rel="stylesheet" href="<?= site_url('assets/plugins/jquery-upload/css/jquery.fileupload-ui-noscript.css'); ?>"></noscript>
    <style>
    /* The container */
    .radio_check {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default radio button */
    .radio_check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .radio_check:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .radio_check input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .radio_check input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .radio_check .checkmark:after {
     	top: 9px;
    	left: 9px;
    	width: 8px;
    	height: 8px;
    	border-radius: 50%;
    	background: white;
    }
    </style>
  <div class="container">
  	<!-- The file upload form used as target for the file upload widget -->
  	<form id="fileupload" action="" method="POST" enctype="multipart/form-data">
       		<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
  		<div class="row fileupload-buttonbar">
  			<div class="col-lg-4">
  				<!-- The fileinput-button span is used to style the file input field as button -->
  				<span style="margin-right:6px" class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>&nbsp;&nbsp;Tambah</span>
              <input type="file" name="files[]" multiple>
           </span>
  				 <button type="submit" class="btn btn-primary start" style="display:none">
    					<i class="glyphicon glyphicon-upload"></i>
    					<span></span>
  				 </button>
  				<button type="reset" class="btn btn-warning cancel">
  					<i class="glyphicon glyphicon-ban-circle"></i>
  					<span>&nbsp;&nbsp;Batal</span>
  				</button>
  				<span class="fileupload-process"></span>
          <label id="img_upload_error" class="control-label" style="color:#a94442;display:none;position:absolute;"><i class="fa fa-ban"></i> Silahkan pilih gambar</label>
  			</div>
  			<!-- The global progress state -->
  			<div class="col-lg-4 fileupload-progress fade">
  				<!-- The global progress bar -->
  				<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
  					<div class="progress-bar progress-bar-success" style="width:0%;"></div>
  				</div>
  				<!-- The extended global progress state -->
  				<div class="progress-extended">&nbsp;</div>
  			</div>
  		</div>
  		<!-- The table listing the files available for upload/download -->
  		<table role="presentation" style="width:60%" class="table table-striped"><tbody class="files"></tbody></table>
  	</form>
  </div>
  <!-- The blueimp Gallery widget -->
  <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
  	<div class="slides"></div>
  	<h3 class="title"></h3>
  	<a class="prev">‹</a>
  	<a class="next">›</a>
  	<a class="close">×</a>
  	<a class="play-pause"></a>
  	<ol class="indicator"></ol>
  </div>
  <!-- The template to display files available for upload -->
  <script id="template-upload" type="text/x-tmpl">
  {% var x=0; for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-upload fade">
          <td>
              <span class="preview"></span>
          </td>
          <td>
              <p class="name">{%=file.name%} </p>
              <strong class="error text-danger"></strong>
          </td>
          <td>
              <p class="size">Processing...</p>
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
          </td>
          <td>
              {% if (!i && !o.options.autoUpload) { %}
                  <button class="btn btn-primary start" disabled style="display:none ">
                      <i class="glyphicon glyphicon-upload"></i>
                      <span>Start</span>
                  </button>
              {% } %}
              {% if (!i) { %}
                  <button class="btn btn-warning cancel">
                      <i class="glyphicon glyphicon-ban-circle"></i>
                      <span>Cancel</span>
                  </button>
                  <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo$this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="max_product_id[]" id="max_product_id">
      <input type="hidden" name="user_id[]" id="user_id" value="<?php echo $this->ion_auth->user()->row()->id; ?>">
                  <input id="check_img_upload" type="hidden" value="{%=file.name%}" />
                  
                  <label class="radio_check" style="float:right">
                    Gambar Utama
                    <input type="radio" id="radio_check[]" name="radio_check[]">
                   
                    <span class="checkmark"></span>
                  </label>
              {% } %}
          </td>
      </tr>
  {% x++; } %}
  </script>

  <!-- The template to display files available for download -->
  <script id="template-download" type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-download fade">
          <td>
              <span class="preview">
                  {% if (file.thumbnailUrl) { %}
                      <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                  {% } %}
              </span>
          </td>
          <td>
              <p class="name">
                  {% if (file.url) { %}
                      <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                  {% } else { %}
                      <span>{%=file.name%}</span>
                  {% } %}
              </p>
              {% if (file.error) { %}
                  <div><span class="label label-danger">Error</span> {%=file.error%}</div>
              {% } %}
          </td>
          <td>
              <span class="size">{%=o.formatFileSize(file.size)%}</span>
          </td>
          <td>
              {% if (file.deleteUrl) { %}
                  <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                      <i class="glyphicon glyphicon-trash"></i>
                      <span>Delete</span>
                  </button>
                  <input type="checkbox" name="delete" value="1" class="toggle">
              {% } else { %}
                  <button class="btn btn-warning cancel">
                      <i class="glyphicon glyphicon-ban-circle"></i>
                      <span>Cancel</span>
                  </button>
              {% } %}
          </td>
      </tr>
  {% } %}
  </script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/vendor/jquery.ui.widget.js'); ?>"></script>
  <!-- The Templates plugin is included to render the upload/download listings -->
  <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
  <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
  <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
  <!-- The Canvas to Blob plugin is included for image resizing functionality -->
  <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
  <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
  <!-- blueimp Gallery script -->
  <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.iframe-transport.js'); ?>"></script>
  <!-- The basic File Upload plugin -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.fileupload.js'); ?>"></script>
  <!-- The File Upload processing plugin -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.fileupload-process.js'); ?>"></script>
  <!-- The File Upload image preview & resize plugin -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.fileupload-image.js'); ?>"></script>
  <!-- The File Upload audio preview plugin -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.fileupload-audio.js'); ?>"></script>
  <!-- The File Upload video preview plugin -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.fileupload-video.js'); ?>"></script>
  <!-- The File Upload validation plugin -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.fileupload-validate.js'); ?>"></script>
  <!-- The File Upload user interface plugin -->
  <script src="<?= site_url('assets/plugins/jquery-upload/js/jquery.fileupload-ui.js'); ?>"></script>
  <!-- The main application script -->

  <script src="<?= site_url('assets/plugins/jquery-cookie/jquery.cookie.js'); ?>"></script>
  <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
  <!--[if (gte IE 8)&(lt IE 10)]>
  <script src="<?= site_url('assets/plugins/jquery-upload/js/cors/jquery.xdr-transport.js'); ?>"></script>
  <![endif]-->

  <script type="text/javascript">

  $(function () {
      'use strict';

      // Initialize the jQuery File Upload widget:
      $('#fileupload').fileupload({
          //redirect :'<?php echo site_url('admin/product') ?>',
          url: '<?php echo site_url('admin/product/upload_product_img') ?>',
  disableImageResize: /Android(?!.*Chrome)|Opera/
      .test(window.navigator && navigator.userAgent),
  imageMaxWidth: 1500,
  imageMaxHeight: 1500,
  imageCrop: false, // Force cropped images
      });
      $('#fileupload').bind('fileuploadsubmit', function (e, data) {
    var inputs = data.context.find(':input');
    if (inputs.filter(function () {
            return !this.value && $(this).prop('required');
            }).first().focus().length) {
            data.context.find('button').prop('disabled', false);
            return false;
        }
        data.formData = inputs.serializeArray();
    });
    $('#fileupload').bind('fileuploadstop', function (e) {
      swal('data berhasil di upload');
      window.location = '<?php echo site_url('admin/product') ?>';
    });

      $('#fileupload').addClass('fileupload-processing');
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      $.ajax({
          url: $('#fileupload').fileupload('option', 'url'),
          dataType: 'json',
          method :'POST',
          context: $('#fileupload')[0]
      }).always(function () {
          $(this).removeClass('fileupload-processing');
      }).done(function (result) {
          $(this).fileupload('option', 'done')
              .call(this, $.Event('done'), {result: result});
             
      }).complete(function (result) {
          
              
      });
  });

  </script>
