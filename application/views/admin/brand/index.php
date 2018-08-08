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
									<?php if ($inserted=='y'): ?>
									<h3 class="box-title"><?php echo anchor('admin/brand/create', '<i class="fa fa-plus"></i> &nbsp;&nbsp;Tambah Brand', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
								<?php endif ?>
								</div>
								<div class="box-body">

									<table class="table table-bordered table-striped">
										<tr>
											<td>Logo</td>
											<td>Brand</td>
											<td>Deskripsi</td>
											<td>Posisi</td>
											<td>Status</td>
											<?php if ($edited=='y'): ?>
												<td>Aksi</td>
											<?php endif ?>
										</tr>
									<?php
										if ( !$brand_list )
										{
											echo "<td colspan=5 align=center>Data Kosong</td>";
										}else{
									foreach( $brand_list as $brand ) {
											$brand_id = $this->encrypt->encode($brand->brand_id);
											$brand_id = strtr($brand_id,array('+' => '.', '=' => '-', '/' => '~')); ?>
												<tr>
													<td align=center><img src="<?php echo base_url('upload/brand/'.$brand->logo_filename); ?>" width="60px"></td>
													<td><?php echo $brand->name; ?></td>
													<td><?php echo $brand->description; ?></td>
													<td><?php echo $brand->order; ?></td>
													<td><?php echo ($brand->active) ? anchor('admin/brand/deactivate/'.$brand_id, '<span class="label label-success">Aktif</span>') : anchor('admin/brand/deactivate/'. $brand_id, '<span class="label label-default">Nonaktif</span>'); ?></td>
													<?php if ($edited=='y' or $deleted=='y'): ?>
														
													<td>
														<?php if ($edited=='y'): ?>
															<?php echo anchor('admin/brand/edit/'.$brand_id, '<i class="fa fa-edit"></i> ', array('class' => 'btn btn-warning btn-flat btn-xs')); ?>
														<?php endif ?>
													</td>
													<?php endif ?>
												</tr>
											<?php } } ?>
									</tr>
									</table>
									<div class="form-group" id="imagers"></div>
								</div>
							</div>
						 </div>
					</div>
				</section>
			</div>
