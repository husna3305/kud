
	<script>

				// Ajax On Menus
				$(document).ready(function(){
						$(".change_show").change( function() {
										var menu_id = $(this).attr("menu_id");
										var group_id = $(this).attr("group_id");
										var status_change = 'show';
								$.ajax({
										url:"<?php echo site_url('admin/menus/ajaxChangeAccess');?>",
										type:"POST",
										data:"menu_id="+menu_id+"&group_id="+group_id+"&status_change="+status_change+
										"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
										//data: {csrfName : csrfHash,"menu_id" : menu_id, "group_id" :group_id},
										cache:false,
										success:function(data){
												csrfName = data.csrfName;
												csrfHash = data.csrfHash;
												swal('sukses');
										}
								})
						});
						$(".change_insert").change( function() {
										var menu_id = $(this).attr("menu_id");
										var group_id = $(this).attr("group_id");
										var status_change = 'inserted';
								$.ajax({
										url:"<?php echo site_url('admin/menus/ajaxChangeAccess');?>",
										type:"POST",
										data:"menu_id="+menu_id+"&group_id="+group_id+"&status_change="+status_change+
										"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
										//data: {csrfName : csrfHash,"menu_id" : menu_id, "group_id" :group_id},
										cache:false,
										success:function(data){
												csrfName = data.csrfName;
												csrfHash = data.csrfHash;
										}
								})
						});
						$(".change_edit").change( function() {
										var menu_id = $(this).attr("menu_id");
										var group_id = $(this).attr("group_id");
										var status_change = 'edited';
								$.ajax({
										url:"<?php echo site_url('admin/menus/ajaxChangeAccess');?>",
										type:"POST",
										data:"menu_id="+menu_id+"&group_id="+group_id+"&status_change="+status_change+
										"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
										//data: {csrfName : csrfHash,"menu_id" : menu_id, "group_id" :group_id},
										cache:false,
										success:function(data){
												csrfName = data.csrfName;
												csrfHash = data.csrfHash;
										}
								})
						});
						$(".change_delete").change( function() {
										var menu_id = $(this).attr("menu_id");
										var group_id = $(this).attr("group_id");
										var status_change = 'deleted';
								$.ajax({
										url:"<?php echo site_url('admin/menus/ajaxChangeAccess');?>",
										type:"POST",
										data:"menu_id="+menu_id+"&group_id="+group_id+"&status_change="+status_change+
										"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
										//data: {csrfName : csrfHash,"menu_id" : menu_id, "group_id" :group_id},
										cache:false,
										success:function(data){
												csrfName = data.csrfName;
												csrfHash = data.csrfHash;
										}
								})
						});
				})
		</script>
							<h4 align="center"><?php echo $group_name ?></h4><hr>
										<table class="table table-striped table-hover">
											<thead>
												<tr >
													<th style="text-align:center">Nama Menu</th>
													<th>Tampil</th>
													<th>Tambah</th>
													<th>Edit</th>
													<th>Hapus</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($menus_list as $values):
													if($values->is_menu_header == 1): ?>
														<tr>
															<td><b><?php echo strtoupper(htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8')); ?></b></td>
															<!--  Cek Menu Header !-->
															<?php if ($menus_prefs_num_rows == 0) {?>
															<td style="text-align:center">
																<input type="checkbox"  class="change_show" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
															</td>
															<!--
															<td style="text-align:center">
																<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
															</td>
															<td style="text-align:center">
																<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
															</td>
															<td style="text-align:center">
																<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
															</td>	 -->
															<?php } else { 
																foreach($menus_prefs as $menus_prefs_value) { 
																	if($menus_prefs_value->menu_id == $values->menu_id and $group_id == $menus_prefs_value->group_id ){ ?>
																		<td style="text-align:center">
																			<input type="checkbox"  class="change_show" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																		<!--
																		<td style="text-align:center">
																			<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->inserted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																		<td style="text-align:center">
																			<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->edited ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																		<td style="text-align:center">
																			<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->deleted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																		</td> -->
																	<?php } ?>
																<?php } ?>
																<?php
																	$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values->menu_id, $group_id);
																	if ( $no_menus_db->num_rows() ==0 )
																	{ ?>
																		<td style="text-align:center">
																			<input class="change_show" menu_id = "<?php echo $values->menu_id; ?>"  group_id = "<?php echo $group_id; ?>" type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																		</td><!--
																		<td style="text-align:center">
																			<input class="change_insert" menu_id = "<?php echo $values->menu_id; ?>"  group_id = "<?php echo $group_id; ?>" type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																		<td style="text-align:center">
																			<input class="change_edit" menu_id = "<?php echo $values->menu_id; ?>"  group_id = "<?php echo $group_id; ?>" type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																		</td>
																		<td style="text-align:center">
																			<input class="change_delete" menu_id = "<?php echo $values->menu_id; ?>"  group_id = "<?php echo $group_id; ?>" type="checkbox" data-toggle="toggle" data-width="50" data-height="25">
																		</td> -->
																	<?php }
																
																?>
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
																		<?php if ($menus_prefs_num_rows == 0) {?>
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<?php } else{ 
																				foreach($menus_prefs as $menus_prefs_value) { 
																					if($menus_prefs_value->menu_id == $values_parents_menu->menu_id and $group_id == $menus_prefs_value->group_id ){ ?>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->inserted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->edited ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->deleted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																					<?php } ?>
																				<?php } ?>
																				<?php
																					$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values_parents_menu->menu_id, $group_id);
																					if ( $no_menus_db->num_rows() ==0 )
																					{ ?>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																					<?php }
																				
																				?>
																			<?php } ?>
																	</tr>
															<?php	}else{
															?>
																<tr>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($values_parents_menu->name, ENT_QUOTES, 'UTF-8'); ?></td>
																	<!--  Cek Is Dropdown    !-->
																		<?php if ($menus_prefs_num_rows == 0) {?>
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<?php } else{ 
																				foreach($menus_prefs as $menus_prefs_value) { 
																					if($menus_prefs_value->menu_id == $values_parents_menu->menu_id and $group_id == $menus_prefs_value->group_id ){ ?>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->inserted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->edited ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->deleted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																					<?php } ?>
																				<?php } ?>
																				<?php
																					$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($values_parents_menu->menu_id, $group_id);
																					if ( $no_menus_db->num_rows() ==0 )
																					{ ?>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_show" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_insert" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_edit" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_delete" menu_id = "<?php echo $values_parents_menu->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																					<?php }
																				
																				?>
																			<?php } ?>
																</tr>
																<?php		
																	foreach( $menus_list as $child_menus )
																	{ if ( $child_menus->parent_id == $values_parents_menu->menu_id )
																	{?>
																	<tr>
																		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($child_menus->name, ENT_QUOTES, 'UTF-8'); ?></td>
																		<!--  Cek Is Dropdown    !-->
																		<?php if ($menus_prefs_num_rows == 0) {?>
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_show" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_insert" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_edit" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<td style="text-align:center">
																				<input type="checkbox"  class="change_delete" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																			</td>	
																			<?php } else{ 
																				foreach($menus_prefs as $menus_prefs_value) { 
																					if($menus_prefs_value->menu_id == $child_menus->menu_id and $group_id == $menus_prefs_value->group_id ){ ?>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_show" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->show ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_insert" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->inserted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_edit" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->edited ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_delete" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" <?php if($menus_prefs_value->deleted ==1){echo "checked";} ?> data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																					<?php } ?>
																				<?php } ?>
																				<?php
																					$no_menus_db = $this->Menus_preferences_model->get_by_menuid_groupid($child_menus->menu_id, $group_id);
																					if ( $no_menus_db->num_rows() ==0 )
																					{ ?>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_show" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_insert" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_edit" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																						<td style="text-align:center">
																							<input type="checkbox"  class="change_delete" menu_id = "<?php echo $child_menus->menu_id; ?>" group_id = "<?php echo $group_id; ?>" data-toggle="toggle" data-width="50" data-height="25">
																						</td>
																					<?php }
																				
																				?>
																			<?php } ?>
																	</tr>
																	
																<?php } } } } } ?>
												<?php endif; endforeach;?>
											</tbody>
										</table>