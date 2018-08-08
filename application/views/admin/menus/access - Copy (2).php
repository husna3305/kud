<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<script>

		// Ajax On Menus
		$(document).ready(function(){
				$(".change_show").change( function() {
								var menu_id = $(this).attr("menu_id");
								var group_id = $(this).attr("group_id");
								var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
								var	csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
						$.ajax({
								url:"<?php echo site_url('admin/menus/ajaxChangeAccess');?>",
								type:"POST",
								data:"menu_id="+menu_id+"&group_id="+group_id+
								"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
								//data: {csrfName : csrfHash,"menu_id" : menu_id, "group_id" :group_id},
								cache:false,
								success:function(data){
										csrfName = data.csrfName;
										csrfHash = data.csrfHash;
								}
						})
						
				})
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
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li><?php echo anchor('admin/menus', 'Daftar Menu'); ?></li>
						<li class="active"><?php echo anchor('admin/menus/access', 'Hak Akses Menu'); ?></li>
					</ul>
					
					<div class="tab-content">
					
						<div class="tab-pane active" id="tab_admin">
								<div class="box-body">
									
									<table class="table table-striped table-hover">
										<thead>
											<tr >
												<th style="text-align:center">Nama Menu</th>
												<?php foreach( $groups as $groups_value ) { ?>
													<th style="text-align:center"><?php echo htmlspecialchars($groups_value->name, ENT_QUOTES, 'UTF-8'); ?></th>
												<?php } ?>
											</tr>
											<tr>
												<th></th>
												<?php foreach( $groups as $groups_value ) { ?>
													<th style="text-align:center">Lihat</th>
													<th style="text-align:center">Tambah</th>
													<th style="text-align:center">Edit</th>
													<th style="text-align:center">Hapus</th>
												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($menus_list as $values):
												if($values->is_menu_header == 1): ?>
													<tr>
														<td><b><?php echo strtoupper(htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8')); ?></b></td>
														<!--  Cek Menu Header !-->
														<?php foreach( $groups as $group_value ) { 
															if ($menus_prefs_num_rows == 0) {?>
															<td style="text-align:center">
																<input type="checkbox"  class="change_show" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" data-toggle="toggle" data-width="50" data-height="25">
															</td>	
															<?php } else{ 
																foreach($menus_prefs as $menus_prefs_value) { 
																	if($menus_prefs_value->menu_id == $values->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																		<td style="text-align:center">
																			<input type="checkbox"  class="change_show" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																	<?php } ?>
																<?php } ?>
																<?php
																	$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values->menu_id, $group_value->id);
																	if ( $no_menus_db->num_rows() ==0 )
																	{ ?>
																		<td style="text-align:center">
																			<input class="change_show" menu_id = "<?php echo $values->menu_id; ?>"  group_id = "<?php echo $group_value->id; ?>" type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
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
																		<td style="text-align:center">
																			
																			<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																		</td>	
																		<?php } else{ 
																			foreach($menus_prefs as $menus_prefs_value) { 
																				if($menus_prefs_value->menu_id == $values_parents_menu->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																					<td style="text-align:center">
																						<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">																						
																					</td>
																				<?php } ?>
																			<?php } ?>
																			<?php
																				$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values_parents_menu->menu_id, $group_value->id);
																				if ( $no_menus_db->num_rows() ==0 )
																				{ ?>
																					<td style="text-align:center">
																						<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" data-toggle="toggle" data-width="50" data-height="25">
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
																		<td style="text-align:center">
																			<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																		</td>	
																		<?php } else{ 
																			foreach($menus_prefs as $menus_prefs_value) { 
																				if($menus_prefs_value->menu_id == $values_parents_menu->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																					<td style="text-align:center">
																						<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php } ?>
																			<?php } ?>
																			<?php
																				$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values_parents_menu->menu_id, $group_value->id);
																				if ( $no_menus_db->num_rows() ==0 )
																				{ ?>
																					<td style="text-align:center">
																						<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" data-toggle="toggle" data-width="50" data-height="25">
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
																		<td style="text-align:center">
																			<input type="checkbox"  class="change_show" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																		</td>	
																		<?php } else{ 
																			foreach($menus_prefs as $menus_prefs_value) { 
																				if($menus_prefs_value->menu_id == $child_menus->menu_id and $group_value->id == $menus_prefs_value->group_id ){ ?>
																					<td style="text-align:center">
																						<input type="checkbox"  class="change_show" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																					</td>
																				<?php } ?>
																			<?php } ?>
																			<?php
																				$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($child_menus->menu_id, $group_value->id);
																				if ( $no_menus_db->num_rows() ==0 )
																				{ ?>
																					<td style="text-align:center">
																						<input type="checkbox"  class="change_show" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_value->id; ?>" data-toggle="toggle" data-width="50" data-height="25">
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
									<!--Test
									<input type="text" id="id_test" name="test" value="" /><br />
									<input type="text" id="id_test2" name="test" value="" />
									<input type="text" id="id_test3" name="test" value="" />
									-->
								
									
								</div>
						</div>
					</div>
				</div>			
			</div>
		 </div>
	</div>
</section>
</div>
