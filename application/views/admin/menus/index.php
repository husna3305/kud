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
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><?php echo anchor('admin/menus', 'Daftar Menu'); ?></li>
						<li><?php echo anchor('admin/menus/access', 'Hak Akses Menu'); ?></li>
						<li class="pull-right">
							<?php echo anchor('admin/menus/create', '<i class="fa fa-plus"></i> ', array('class' => 't')); ?>
						
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane active" id="tab_admin">
								<div class="box-body">
									<div class="box-header with-border">
										<h3 class="box-title"><?php echo anchor('admin/menus/create', '<i class="fa fa-plus"></i> &nbsp; Menu Baru', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
									</div>
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th>Nama Menu</th>
												<th>Link</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($menus_list as $values):
												if($values->is_menu_header == 1): 
													$menu_id = $this->encrypt->encode($values->menu_id);
													$menu_id = strtr($menu_id,array('+' => '.', '=' => '-', '/' => '~'));
												?>
													<tr>
														<td><b><?php echo strtoupper(htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8')); ?></b></td>
														<td><?php echo htmlspecialchars($values->link, ENT_QUOTES, 'UTF-8'); ?></td>
														<td><?php echo ($values->active) ? anchor('admin/menus/deactivate/'.$menu_id, '<span class="label label-success">Aktif</span>') : anchor('admin/menus/deactivate/'. $menu_id, '<span class="label label-default">Nonaktif</span>'); ?></td>
														<td>
															<?php 
																echo anchor("admin/menus/edit/".$menu_id,  '<i class="fa fa-edit"></i> ', array('class' => 'btn btn-warning btn-flat btn-xs'));  
															?>
														</td>
													</tr>
												<?php
													foreach( $menus_list as $values_parents_menu ) {
														if ( $values_parents_menu->menu_header_id == $values->menu_id ) { 
															if ( $values_parents_menu->is_dropdown == 0 )
															{ 
															$menu_id = $this->encrypt->encode($values_parents_menu->menu_id);
																		$menu_id = strtr($menu_id,array('+' => '.', '=' => '-', '/' => '~'));
															?>
																<tr>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($values_parents_menu->name, ENT_QUOTES, 'UTF-8'); ?></td>
																	<td><?php echo htmlspecialchars($values_parents_menu->link, ENT_QUOTES, 'UTF-8'); ?></td>
																	<td><?php echo ($values_parents_menu->active) ? anchor('admin/menus/deactivate/'.$menu_id, '<span class="label label-success">Aktif</span>') : anchor('admin/menus/deactivate/'. $menu_id, '<span class="label label-default">Nonaktif</span>'); ?></td>
																	<td><?php  
																		echo anchor("admin/menus/edit/".$menu_id,  '<i class="fa fa-edit"></i> ', array('class' => 'btn btn-warning btn-flat btn-xs')); ?>
																	</td>
																</tr>
														<?php	}else{
														$menu_id = $this->encrypt->encode($values_parents_menu->menu_id);
																	$menu_id = strtr($menu_id,array('+' => '.', '=' => '-', '/' => '~'));
														?>
															<tr>
																<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($values_parents_menu->name, ENT_QUOTES, 'UTF-8'); ?></td>
																<td><?php echo htmlspecialchars($values_parents_menu->link, ENT_QUOTES, 'UTF-8'); ?></td>
																<td><?php echo ($values_parents_menu->active) ? anchor('admin/menus/deactivate/'.$menu_id, '<span class="label label-success">Aktif</span>') : anchor('admin/menus/deactivate/'. $menu_id, '<span class="label label-default">Nonaktif</span>'); ?></td>
																<td><?php 
																	
																	echo anchor("admin/menus/edit/".$menu_id,  '<i class="fa fa-edit"></i> ', array('class' => 'btn btn-warning btn-flat btn-xs')); ?>
																</td>
															</tr>
															<?php		
																foreach( $menus_list as $child_menus )
																{ if ( $child_menus->parent_id == $values_parents_menu->menu_id )
																{
																$menu_id = $this->encrypt->encode($child_menus->menu_id);
																		$menu_id = strtr($menu_id,array('+' => '.', '=' => '-', '/' => '~'));
																?>
																<tr>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($child_menus->name, ENT_QUOTES, 'UTF-8'); ?></td>
																	<td><?php echo htmlspecialchars($child_menus->link, ENT_QUOTES, 'UTF-8'); ?></td>
																	<td><?php echo ($child_menus->active) ? anchor('admin/menus/deactivate/'.$menu_id, '<span class="label label-success">Aktif</span>') : anchor('admin/menus/deactivate/'. $menu_id, '<span class="label label-default">Nonaktif</span>'); ?></td>
																	<td><?php 
																		
																		echo anchor("admin/menus/edit/".$menu_id,  '<i class="fa fa-edit"></i> ', array('class' => 'btn btn-warning btn-flat btn-xs'));?>
																	</td>
																</tr>
																
															<?php } } } } } ?>
											<?php endif; endforeach;?>
										</tbody>
									</table>	
									

								</div>
						</div>
					</div>
				</div>			
			</div>
		 </div>
	</div>
</section>
</div>
