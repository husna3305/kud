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
							 <div class="box">
								<div class="box-header with-border">

									<h3 class="box-title" style="padding-bottom: 5px;"><?php echo anchor('admin/product/create', '<i class="fa fa-plus"></i> &nbsp;&nbsp;Tambah Produk', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>&nbsp;&nbsp;
									<h3 class="box-title"><?php echo anchor('admin/product/dd', '<i class="fa fa-trash"></i> &nbsp;&nbsp;Produk Dihapus', array('class' => 'btn btn-block btn-warning btn-flat')); ?></h3>
								</div>
								<div class="box-body">

									<table class="table table-responsive table-bordered table-striped" id="table1" style="width:100%">
										<thead>
											<tr style="font-weight:bold;text-align:center;">
												<td style="width:40%" class="wrapword">Produk</td>
												<td>Pengaturan Produk</td>
												<td>Status</td>
											</tr>
										</thead>
									<tbody>
										<?php
											if ( !$product_list )
											{
												echo "<td colspan=5 align=center>Data Kosong</td>";
											}else{
										foreach( $product_list as $product ) {
												$active = $product->active;
												$product_id = $this->encrypt->encode($product->product_id);
												$product_id = strtr($product_id,array('+' => '.', '=' => '-', '/' => '~')); ?>
													<tr style="height:150px;">
														<td style="width:60%">
															<!-- Show Images -->
															<?php $x=0; foreach ($product_img as $p_i	): ?>
																		<?php if ($p_i->product_id == $product->product_id and $p_i->main_file == 1): ?>
																				<div class="col-md-3">
																					<img src="<?php echo base_url('upload/product/'.$p_i->filename); ?>" class="img-responsive img-rounded" width="95px">
																				</div>
																				<?php $x++; ?>
																		<?php endif; ?>
																<?php endforeach; ?>
																<?php if ($x ==0): ?>
																	<div class="col-md-3">
																		<img src="<?php echo base_url('upload/product/no_img.jpeg'); ?>" class="img-responsive img-rounded" width="95px">
																	</div>
																<?php endif; ?>
																<div class="col-md-9">
																	<div class="wrapword">
																		<?php echo anchor('admin/product/show/'.$product_id, '<b>'.ucwords($product->pd_name).'</b>', array('class' => '')); ?>
																	</div>
																	<!-- Show Category -->
																	<b>Kategori :</b>&nbsp;
																		<?php $c=0; foreach ($product_category as $count) { if ($count->product_id == $product->product_id) { $c++; }}
																		if ($c <= 1) { echo "&nbsp;-";}
																		$i=1;foreach ($product_category as $c_p) {
																					if ($c_p->product_id == $product->product_id) {echo $c_p->name; if ($i < $c) { echo ", ";} $i++;}
																				} ?><br>
																	<b>Kondisi Produk :</b>&nbsp;
																	<?php echo $product->cond_name ?><br>
																	<?php if ($this->Wholesale_model->get_by_productid($product->product_id)->num_rows() > 0): ?>
																		<span>
																			<small class="label bg-green">Grosir</small>
																		</span>
																	<?php endif; ?><br>
																	<?php if ($this->Discount_model->get_by_productid($product->product_id)->num_rows() > 0){ ?>
																		<?php $text_discount = "Set Diskon" ?>
																		<span>
																			<small class="label" style="background-color:#00c0ef">Diskon</small>
																		</span>
																	<?php } else{ ?>
																		<?php $text_discount = "Tambah Diskon" ?>
																	<?php } ?>
																</div>
														</td>
														<td>
																<a data-toggle="modal" data-target=".modal_discount" data-product_id="<?php echo $product_id ?>" href="#modal_discount" ><i class="fa fa-tags" style="margin-bottom:9px;"></i> <?php echo $text_discount ?></a><br>
																<?php if ($this->Wholesale_model->get_by_productid($product->product_id)->num_rows() > 0){ ?>
																		<a data-toggle="modal" data-target=".modal_wholesale" data-product_id="<?php echo $product_id ?>" href="#modal_wholesale" ><i class="fa fa-tasks" style="margin-bottom:9px;"></i> Set Harga Grosir</a><br>
																<?php }else{ ?>
																		<a data-toggle="modal" data-target=".modal_wholesale" data-product_id="<?php echo $product_id ?>" href="#modal_wholesale" ><i class="fa fa-tasks" style="margin-bottom:9px;"></i> Tambah Harga Grosir</a><br>
																<?php } ?>
																<?php if ($this->Product_model->get_by_combineproductid($product->product_id)->num_rows()>0){ ?>
																	<a data-toggle="modal" data-target=".modal_combine" data-product_id="<?php echo $product_id ?>" href="#modal_combine"><i class="fa fa-th-large" style="margin-bottom:9px;"></i> Set Kombinasi Produk</a>
																<?php }else{ ?>
																	<a data-toggle="modal" data-target=".modal_combine" data-product_id="<?php echo $product_id ?>" href="#modal_combine"><i class="fa fa-th-large" style="margin-bottom:9px;"></i> Tambah Kombinasi Produk</a>
																<?php } ?>
																<br>														
																<a href="#" class="set_status" data-product_id="<?php echo $product_id ?>" data-active="<?php echo $active ?>" ><i class="fa fa-check-square" style="margin-bottom:9px;"></i> Set Status</a><br>
																<a href="#"><i class="fa fa-edit" style="margin-bottom:9px;"></i> Ubah Produk</a><br>
																<a href="#" class="hapus_produk" data-product_id="<?php echo $product_id ?>" data-deleted="<?php echo $product->deleted ?>" ><i class="fa fa-trash" style="margin-bottom:9px;"></i> Hapus Produk</a>
														</td>
														<td align=left>
															Status : &nbsp;<?php if ($active==0){?> <small class="label label-default">Nonaktif</small><?php }else{ ?>
																	<small class="label bg-green">Aktif</small>
															<?php } ?>
														</td>

													</tr>
												<?php } } ?>
										</tr>
										</table>
									</tbody>
									<div class="form-group">

 <h2>Stacked Bootstrap Modal Example.</h2>
 <a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">Modal 1</h4>

            </div>
            <div class="container"></div>
            <div class="modal-body">Content for the dialog / modal goes here.
                <br>
                <br>
                <br>
                <p>more content</p>
                <br>
                <br>
                <br>	<a data-toggle="modal" href="#myModal2" class="btn btn-primary">Launch modal</a>

            </div>
            <div class="modal-footer">	<a href="#" data-dismiss="modal" class="btn">Close</a>
	<a href="#" class="btn btn-primary">Save changes</a>

            </div>
        </div>
    </div>
</div>
<div class="modal fade rotate" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">Modal 2</h4>

            </div>
            <div class="container"></div>
            <div class="modal-body">Content for the dialog / modal goes here.
                <br>
                <br>
                <p>come content</p>
                <br>
                <br>
                <br>	<a data-toggle="modal" href="#myModal3" class="btn btn-primary">Launch modal</a>

            </div>
            <div class="modal-footer">	<a href="#" data-dismiss="modal" class="btn">Close</a>
	<a href="#" class="btn btn-primary">Save changes</a>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">Modal 3</h4>

            </div>
            <div class="container"></div>
            <div class="modal-body">Content for the dialog / modal goes here.
                <br>
                <br>
                <br>
                <br>
                <br>	<a data-toggle="modal" href="#myModal4" class="btn btn-primary">Launch modal</a>

            </div>
            <div class="modal-footer">	<a href="#" data-dismiss="modal" class="btn">Close</a>
	<a href="#" class="btn btn-primary">Save changes</a>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">Modal 4</h4>

            </div>
            <div class="container"></div>
            <div class="modal-body">Content for the dialog / modal goes here.</div>
            <div class="modal-footer">	<a href="#" data-dismiss="modal" class="btn">Close</a>
	<a href="#" class="btn btn-primary">Save changes</a>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {

    $('#openBtn').click(function () {
        $('#myModal').modal({
            show: true
        })
    });

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


});
</script>





								</div>
							</div>
						 </div>
					</div>
				</section>
			</div>

<!--  Modal Discount -->
<div class="modal fade modal_discount">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    	   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	   <span aria-hidden="true">&times;</span></button>
    	   <h4 class="modal-title"><b>Set Dikon</b></h4>
      </div>
      <div class="modal-body" id="show_data_discount">
      </div>
      <div class="modal-footer">
    	   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		/* Modal Discount */
		$('.modal_discount').on('show.bs.modal', function(e) {
					 var product_id = $(e.relatedTarget).data('product_id');
				//	 $("#count_search").val(count_search);
					 var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
					 var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
					 $.ajax({
							 url:"<?php echo site_url('admin/product/ajaxSearchDiscount');?>",
							 type:"POST",
							 data:"product_id="+product_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
							 cache:false,
							 success:function(html){
									$("#show_data_discount").html(html);
							 }
					})
		});

	});
</script>
<!-- End Of Modal Discount -->


<!--  Modal Wholesale -->
<div class="modal fade modal_wholesale">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    	   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	   <span aria-hidden="true">&times;</span></button>
    	   <h4 class="modal-title"><b>Set Harga Grosir</b></h4>
      </div>
      <div class="modal-body" id="show_data_wholesale">
      </div>
      <div class="modal-footer">
    	   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		/* Modal Discount */
		$('.modal_wholesale').on('show.bs.modal', function(e) {
					 var product_id = $(e.relatedTarget).data('product_id');
				//	 $("#count_search").val(count_search);
					 var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
					 var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
					 $.ajax({
							 url:"<?php echo site_url('admin/product/ajaxSearchWholesale');?>",
							 type:"POST",
							 data:"product_id="+product_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
							 cache:false,
							 success:function(html){
									$("#show_data_wholesale").html(html);
							 }
					})
		});

	});
</script>
<!-- End Of Modal Wholesale -->

<!--  Modal Combine -->
<div class="modal fade modal_combine">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    	   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	   <span aria-hidden="true">&times;</span></button>
    	   <h4 class="modal-title"><b>Set Kombinasi Produk</b></h4>
      </div>
      <div class="modal-body" id="show_data_combine">
      </div>
      <div class="modal-footer">
    	   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		/* Modal Discount */
		$('.modal_combine').on('show.bs.modal', function(e) {
					 var product_id = $(e.relatedTarget).data('product_id');
				//	 $("#count_search").val(count_search);
					 var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
					 var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
					 $.ajax({
							 url:"<?php echo site_url('admin/product/ajaxSearchCombine');?>",
							 type:"POST",
							 data:"product_id="+product_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
							 cache:false,
							 success:function(html){
									$("#show_data_combine").html(html);
							 }
					})
		});

	});
</script>
<!-- End Of Modal Combine -->





<script type="text/javascript">
	$('#table1').on('click','.set_status',function(){
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
			  reverseButtons: true
			}).then((result) => {
			  if (result.value) {
			  	var product_id = $(this).data('product_id'); //get value input
			  	var active = $(this).data('active'); //get value input
			    $.ajax({
					 url:"<?php echo site_url('admin/product/setStatus');?>",
					 type:"POST",
					 data:"product_id="+product_id+"&active="+active+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
					 cache:false,
					 success:function(html){
						window.location.reload(true);
					 }
				})
			  }
			}); //End Of Swal
	}); //End Of #table1 .set_status
	$('#table1').on('click','.hapus_produk',function(){
		swal({
			  title: 'Apakah Anda Yakin Ingin Menghapus Produk Ini ?',
			  text: "Produk Yang Terhapus Akan Masuk Kedalam Trash",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya',
			  cancelButtonText: 'Batal',
			  confirmButtonClass: 'btn btn-success',
			  cancelButtonClass: 'btn btn-danger',
			  buttonsStyling: false,
			  reverseButtons: true
			}).then((result) => {
			  if (result.value) {
			  	var product_id = $(this).data('product_id'); //get value input
			  	var deleted = $(this).data('deleted'); //get value input
			    $.ajax({
					 url:"<?php echo site_url('admin/product/hapusProduk');?>",
					 type:"POST",
					 data:"product_id="+product_id+"&deleted="+deleted+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
					 cache:false,
					 success:function(html){
						window.location.reload(true);
					 }
				})
			  }
			}); //End Of Swal
	}); //End Of #table1 .set_status
</script>




