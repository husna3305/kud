<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style type="text/css">
	.modal-dialog {
  height: 90%;
  width: 100%;
  display: flex;
  align-items: center;
}

.modal-content {
  margin: 0 auto;
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
					<div class="row">
						<div class="col-md-6">
							<a href="<?php echo site_url('admin/belanjabarang/bysuplier') ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;Kembali</a>
							<div class="btn-group" style="margin-left: 10px">
								<button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target=".modal_filter"><i class="fa fa-list"></i>&nbsp;&nbsp;Filter Data</button></div></div>

						<div class="col-md-6" style="text-align: right;">
							<h3 class="box-title">
								<button class="btn btn-block btn-success" id="btn_print"><i class="fa fa-print"></i> &nbsp;&nbsp;Cetak</button>
						</div>
					</div>
				</div>
			</div>
		 <iframe style="overflow: auto; border: 0px solid #fff; width: 100%; height: 422px;margin-bottom: -5px;" id="printf"></iframe>
		</div>
	</div>
	
</section>
</div>


<!-- Modal Filter -->
<div class="modal fade modal_filter">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">Filter Data</h4>
      </div>
      <div class="modal-body">
      	<div class="form-horizontal">
			<div class="form-group">
				<label for="link" class="col-sm-8 control-label" style="text-align:left"><b style="text-align:right;">Periode :</b></label>
				<div class="col-sm-12">
					<input type="text" name="tanggal" class="form-control tanggal datepicker" readonly="" id="periode_mulai">
					<label class="control-label" id="tanggal_mulai_error" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan tentukan tanggal mulai periode</label>
				</div>
			</div>
			<div class="form-group"><label for="link" class="col-sm-8 control-label" style="text-align:left"><b style="text-align:right;">&nbsp;&nbsp;Hingga :</b></label>
				<div class="col-sm-12">
					<input type="text" name="tanggal" class="form-control tanggal datepicker_end" readonly="" id="periode_selesai">
					<label class="control-label" id="tanggal_selesai_error" style="color:#a94442;display:none; text-align: left;"><i class="fa fa-ban"></i> Silahkan tentukan tanggal mulai periode</label>
				</div></div>
		</div>
      </div>
      <div class="modal-footer text-center">
       <div style="margin-left: 34%;width: 30%;">
       	<button class="btn btn-primary btn_tampilkan" style="text-align: center;">Tampilkan</button>
       </div>
      </div>
    </div>
  </div>
</div>
<!-- End Of Modal Filter -->

<script type="text/javascript">
	$('#btn_print').click(function(e) {
	e.preventDefault();

    var newWin = document.getElementById('printf').contentWindow;
   	newWin.print();
})

	$('.btn_tampilkan').click(function(e) {
		var tgl_mulai = $("#periode_mulai").val();
		var tgl_selesai = $("#periode_selesai").val();
	e.preventDefault();
    $("#printf").attr("src", '<?php echo site_url('admin/belanjabarang/bysuplierdetail_cetak/'.$this->uri->segment(4)) ?>/'+tgl_mulai+'/'+tgl_selesai);
                $(".modal_filter").modal('hide');

    /*
    e.preventDefault();
	 $.ajax({
             url:"<?php echo site_url('admin/belanjabarang/bysuplierdetail_cetak/'.$this->uri->segment(4));?>",
             type:"POST",
             data:"<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
             cache:false,
             success:function(html){
                $("#printf").html(html);
                $(".modal_filter").modal('hide');
             }
        }); */
})

	
</script>
<script>
    $(document).ready(function(){
    	$('.modal_filter').modal('show');

    	//$("#printf").attr("src", "<?php echo site_url('admin/belanjabarang/bysuplierdetail_cetak/'.$this->uri->segment(4)) ?>");

	    var datepicker_end = $('#datepicker_end').val();
	    $('.datepicker_end').datepicker({
	      autoclose: true,
	      format:'yyyy-mm-dd',
	      endDate: '+0d',
	      startDate: datepicker_end,
	    })
    })
    </script>