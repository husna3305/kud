<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

			<aside class="main-sidebar">
				<section class="sidebar">
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
							<img style="max-width: 35px;" src="<?php echo base_url('assets/img/profile/'); ?><?php echo $this->ion_auth->user()->row()->picture_name ?>" class="img-circle" width="20px" alt="User Image">
						</div>
						<div class="pull-left info">
							<p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
						</div>
					</div>
					
<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
					<!-- Search form -->
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>

<?php endif; ?>
					<!-- Sidebar menu -->
				<?php $group = $this->ion_auth->get_users_groups()->result() ?>
					<ul class="sidebar-menu">
					<?php 
						//Looping Navigation Menus
						foreach ($menus as $values){?>
						<?php 
							$tampil_menu=0;
							//Checking Menu Header
							if ( $values->is_menu_header == 1 ) { ?>
								<?php foreach ($menus_prefs as $prefs){
									foreach ($group as $gr) {
										if ($gr->id==$prefs->group_id AND $values->menu_id==$prefs->menu_id) {
											if ($prefs->show==1) {
												$tampil_menu++;
											}
										}
									}
								} ?>
								<?php if ($tampil_menu >=1): ?>
									<li class="header text-uppercase"><?php echo htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8'); ?></li>
								<?php endif ?>
								<?php 
									// Looping Menu Header->Menus
									foreach( $menus as $values_parent_menu ) { ?>
									<?php 
										$tampil_menu=0;
										// Checking->Menus
										if ( $values_parent_menu->menu_header_id == $values->menu_id )
										{ ?>
											<?php
											if ( $values_parent_menu->is_dropdown == 0 )
											{ ?>
												<?php foreach ($menus_prefs as $prefs){
													foreach ($group as $gr) {
														if ($gr->id==$prefs->group_id AND $values_parent_menu->menu_id==$prefs->menu_id) {
															if ($prefs->show==1) {
																$tampil_menu++;
															}
														}
													}
												} ?>
											<?php if ($tampil_menu>=1): ?>
												<li>
													<a href="<?php echo site_url($values_parent_menu->link); ?>">
														<i class="fa <?php echo htmlspecialchars($values_parent_menu->fa_icon, ENT_QUOTES, 'UTF-8'); ?>"></i> <span><?php echo htmlspecialchars($values_parent_menu->name, ENT_QUOTES, 'UTF-8'); ?></span>
													</a>
												</li>
											<?php endif ?>
											<?php } else{ ?>

												<?php foreach ($menus_prefs as $prefs){
													foreach ($group as $gr) {
														if ($gr->id==$prefs->group_id AND $values_parent_menu->menu_id==$prefs->menu_id) {
															if ($prefs->show==1) {
																$tampil_menu++;
															}
														}
													}
												} ?>
											<?php if ($tampil_menu>=1): ?>
												<li class="treeview">
													<a href="#">
														<i class="fa <?php echo htmlspecialchars($values_parent_menu->fa_icon, ENT_QUOTES, 'UTF-8'); ?>"></i>
														<span><?php echo htmlspecialchars($values_parent_menu->name, ENT_QUOTES, 'UTF-8'); ?></span>
														<span class="pull-right-container">
											              <i class="fa fa-angle-left pull-right"></i>
											            </span>
													</a>
													<ul class="treeview-menu">
														<?php
														
															foreach( $menus as $child_menus )
															{ $tampil_menu=0;
																if ( $child_menus->parent_id == $values_parent_menu->menu_id )
															{?>
																<?php foreach ($menus_prefs as $prefs){
																	foreach ($group as $gr) {
																		if ($gr->id==$prefs->group_id AND $child_menus->menu_id==$prefs->menu_id) {
																			if ($prefs->show==1) {
																				$tampil_menu++;
																			}
																		}
																	}
																} ?>
															<?php if ($tampil_menu>=1): ?>
																<li><a href="<?php echo site_url($child_menus->link); ?>"><?php echo htmlspecialchars($child_menus->name, ENT_QUOTES, 'UTF-8'); ?></a></li>
															<?php endif ?>
															
															<?php }
																# code...
															}
														
														?>
													</ul>
												</li>
												<?php endif ?>
											<?php } ?>	
										<?php } ?>							
								<?php } ?>
							<?php } ?>
					<?php } ?>
					</ul>
				</section>
			</aside>
