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
						<li><?php echo anchor('admin/menus', 'Daftar Menu'); ?></li>
						<li class="active"><?php echo anchor('admin/menus/access', 'Hak Akses Menu'); ?></li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane active" id="tab_admin">
								<div class="box-body">
									<div class="box-header with-border">
										<h3 class="box-title"><?php echo anchor('admin/menus/create', '<i class="fa fa-plus"></i> '. lang('menus_create'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
									</div>
									<table class="table table-striped table-hover">
										<thead>
											<tr >
												<th style="text-align:center">Nama Menu</th>
												<?php foreach( $groups as $groups_value ) { ?>
													<th style="text-align:center"><?php echo htmlspecialchars($groups_value->name, ENT_QUOTES, 'UTF-8'); ?></th>
												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($menus_list as $values):
												if($values->is_menu_header == 1): ?>
													<tr>
														<td><b><?php echo strtoupper(htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8')); ?></b></td>
														<!--  Cek Menu Header    !-->
														<?php foreach( $groups as $group_value ) { 
															if ($menus_prefs_num_rows == 0) {?>
															<td><?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																<?php echo htmlspecialchars($values->menu_id, ENT_QUOTES, 'UTF-8'); ?>
																<input type="checkbox" checked data-toggle="toggle" data-width="50" data-height="25">
															</td>	
															<?php } else{ 
																foreach($menus_prefs as $menus_prefs_value) { 
																	if($menus_prefs_value->menu_id == $values->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																		<td>
																			<?php echo htmlspecialchars($menus_prefs_value->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																			<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																			<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																			<?php echo htmlspecialchars($values->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																			<input type="checkbox" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																	<?php } ?>
																<?php } ?>
																<?php
																	$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values->menu_id, $group_value->id);
																	if ( $no_menus_db->num_rows() ==0 )
																	{ ?>
																		<td>
																			
																			<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																			<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																			<?php echo htmlspecialchars($values->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																			<input type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																	<?php }
																
																?>
															<?php } ?>
															
														<?php } ?>
													</tr>
													
													
												<?php
													foreach( $menus_list as $values_parents_menu ) {
														if ( $values_parents_menu->menu_header_id == $values->menu_id ) { 
															if ( $values_parents_menu->is_dropdown == 0 )
															{ ?>
																<tr>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($values_parents_menu->name, ENT_QUOTES, 'UTF-8'); ?></td>
																	<!--  Cek Is Not Dropdown    !-->
																	<?php foreach( $groups as $group_value ) { 
																		if ($menus_prefs_num_rows == 0) {?>
																		<td><?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																			<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																			<?php echo htmlspecialchars($values_parents_menu->menu_id, ENT_QUOTES, 'UTF-8'); ?>
																			<input type="checkbox" checked data-toggle="toggle" data-width="50" data-height="25">
																		</td>	
																		<?php } else{ 
																			foreach($menus_prefs as $menus_prefs_value) { 
																				if($menus_prefs_value->menu_id == $values_parents_menu->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																					<td>
																						<?php echo htmlspecialchars($menus_prefs_value->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																						<?php echo htmlspecialchars($values_parents_menu->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<input type="checkbox" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php } ?>
																			<?php } ?>
																			<?php
																				$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values_parents_menu->menu_id, $group_value->id);
																				if ( $no_menus_db->num_rows() ==0 )
																				{ ?>
																					<td>
																						
																						<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																						<?php echo htmlspecialchars($values_parents_menu->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<input type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php }
																			
																			?>
																		<?php } ?>
																		
																	<?php } ?>
																</tr>
														<?php	}else{
														?>
															<tr>
																<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($values_parents_menu->name, ENT_QUOTES, 'UTF-8'); ?></td>
																<!--  Cek Is Dropdown    !-->
																	<?php foreach( $groups as $group_value ) { 
																		if ($menus_prefs_num_rows == 0) {?>
																		<td><?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																			<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																			<?php echo htmlspecialchars($values_parents_menu->menu_id, ENT_QUOTES, 'UTF-8'); ?>
																			<input type="checkbox" checked data-toggle="toggle" data-width="50" data-height="25">
																		</td>	
																		<?php } else{ 
																			foreach($menus_prefs as $menus_prefs_value) { 
																				if($menus_prefs_value->menu_id == $values_parents_menu->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																					<td>
																						<?php echo htmlspecialchars($menus_prefs_value->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																						<?php echo htmlspecialchars($values_parents_menu->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<input type="checkbox" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php } ?>
																			<?php } ?>
																			<?php
																				$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values_parents_menu->menu_id, $group_value->id);
																				if ( $no_menus_db->num_rows() ==0 )
																				{ ?>
																					<td>
																						
																						<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																						<?php echo htmlspecialchars($values_parents_menu->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<input type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php }
																			
																			?>
																		<?php } ?>
																		
																	<?php } ?>
															</tr>
															<?php		
																foreach( $menus_list as $child_menus )
																{ if ( $child_menus->parent_id == $values_parents_menu->menu_id )
																{?>
																<tr>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($child_menus->name, ENT_QUOTES, 'UTF-8'); ?></td>
																	<!--  Cek Is Dropdown    !-->
																	<?php foreach( $groups as $group_value ) { 
																		if ($menus_prefs_num_rows == 0) {?>
																		<td><?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																			<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																			<?php echo htmlspecialchars($child_menus->menu_id, ENT_QUOTES, 'UTF-8'); ?>
																			<input type="checkbox" checked data-toggle="toggle" data-width="50" data-height="25">
																		</td>	
																		<?php } else{ 
																			foreach($menus_prefs as $menus_prefs_value) { 
																				if($menus_prefs_value->menu_id == $child_menus->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																					<td>
																						<?php echo htmlspecialchars($menus_prefs_value->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																						<?php echo htmlspecialchars($child_menus->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<input type="checkbox" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php } ?>
																			<?php } ?>
																			<?php
																				$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($child_menus->menu_id, $group_value->id);
																				if ( $no_menus_db->num_rows() ==0 )
																				{ ?>
																					<td>
																						
																						<?php echo htmlspecialchars($group_value->name, ENT_QUOTES, 'UTF-8'); ?>,
																						<?php echo htmlspecialchars($group_value->id, ENT_QUOTES, 'UTF-8'); ?>, 
																						<?php echo htmlspecialchars($child_menus->menu_id, ENT_QUOTES, 'UTF-8'); ?>,
																						<input type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php }
																			
																			?>
																		<?php } ?>
																		
																	<?php } ?>
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
