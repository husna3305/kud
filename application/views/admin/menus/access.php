<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style type="text/css">
	.active_btn{
		    background-color: #3c8dbc;
    border-color: #367fa9;
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
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li><?php echo anchor('admin/menus', 'Daftar Menu'); ?></li>
						<li class="active"><?php echo anchor('admin/menus/access', 'Hak Akses Menu'); ?></li>
					</ul>
					
					<div class="tab-content">
						<div class="row">
							<div class="col-md-3">
								<div id="groups">
									<br>
									<?php foreach( $groups as $groups_value ) { ?>
										<button type="button" class="btn btn-block btn-info btn-select_group" id="btn_<?php echo $groups_value->id ?>" group_id="<?php echo $groups_value->id ?>" group_name="<?php echo $groups_value->name ?>"><?php echo htmlspecialchars($groups_value->name, ENT_QUOTES, 'UTF-8'); ?></button>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-9">
								<div class="box">
									<div class="tab-pane active" id="tab_admin">
										<div class="box-body" id="content-access"></div>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>			
				</div>
		 	</div>
		</div>
</section>
</div>
<script type="text/javascript">
	$('#groups').on('click','.btn-select_group',function(){
		var group_id=$(this).attr('group_id');
		var group_name=$(this).attr('group_name');
		$.ajax({
			 url:"<?php echo site_url('admin/menus/ajaxShowContentAccess');?>",
			 type:"POST",
			 data:"group_id="+group_id+"&group_name="+group_name+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo$this->security->get_csrf_hash(); ?>",
			 cache:false,
			 success:function(html){
					$("#content-access").html(html);
			 }
		})
	});

</script>