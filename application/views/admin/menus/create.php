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
                                    <h3 class="box-title">Form Menu Baru</h3>
                                </div>
                                <div class="box-body" style="padding-left:30px;">
                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
                                        <div class="form-group " >
                                            <label for="name" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Nama Menu</b> <br />
                                                <i style="font-size:12px;">Tulis nama menu</i>                          
                                            </label>
                                            <div class="col-sm-3 ">
                                                <input type="text" name="name" value="<?php echo set_value('name') ?>" id="name" class="form-control"/>
                                                
                                            </div>
                                            <div class="col-sm-6">
                                                <?php if (validation_errors()) { ?>
                                                <i style="color:red;margin-bottom:0px;"><?php echo form_error('name') ?></i>
                                                <?php } ?>  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="link" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Link Menu</b> <br />
                                                <i style="font-size:12px;">Tulis link menu</i>                          
                                            </label>
                                            <div class="col-sm-5 " >
                                                <input type="text" name="link" value="<?php echo set_value('link') ?>" id="link" class="form-control"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <?php if (validation_errors()) { ?>
                                                <i style="color:red;margin-bottom:0px;"><?php echo form_error('link') ?></i>
                                                <?php } ?>  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="is_parent" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Parent Menu</b> <br />
                                                <i style="font-size:12px;">Aktifkan jika menu yang akan dibuat adalah parent menu</i>                          
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="is_parent" name="is_parent" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="link" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Pilih Parent Menu</b> <br />
                                                <i style="font-size:12px;">Pilih Parent Menu untuk menu yang akan dibuat  </i>                          
                                            </label>
                                            <div class="col-sm-4 " >
                                                <select name="parent_id" class="form-control">
                                                    <option value="" selected="selected">--Pilih Parent Menu--</option>
                                                    <?php foreach( $menus_parent as $mp ) { ?>
                                                        <option value="<?php echo $mp->menu_id ?>" <?php echo  set_select('parent_id', $mp->menu_id ); ?> ><?php echo $mp->name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <?php if (validation_errors()) { ?>
                                                <i style="color:red;margin-bottom:0px;"><?php echo form_error('parent_id') ?></i>
                                                <?php } ?>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="is_dropdown" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Dropdown Menu</b> <br />
                                                <i style="font-size:12px;">Aktifkan jika menu yang akan dibuat adalah parent dari dropdown menu</i>                          
                                            </label>
                                            <div class="col-sm-5">
                                                <input type="checkbox" id="is_dropdown" name="is_dropdown" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak">
                                            </div>
                                            <div class="col-sm-4">
                                                <?php if (validation_errors()) { ?>
                                                <i style="color:red;margin-bottom:0px;"><?php echo form_error('is_dropdown') ?></i>
                                                <?php } ?>  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="is_menu_header" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Header Menu</b> <br />
                                                <i style="font-size:12px;">Aktifkan jika menu yang akan dibuat adalah header menu</i>                          
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="is_menu_header" name="is_menu_header" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="menu_header_id" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Pilih Header Menu</b> <br />
                                                <i style="font-size:12px;">Pilih Header Menu untuk menu yang akan dibuat</i>                          
                                            </label>
                                            <div class="col-sm-4">
                                                <select name="menu_header_id" class="form-control">
                                                    <option value="" selected="selected">--Pilih Header Menu--</option>
                                                    <?php foreach( $menus_header as $mh ) { ?>
                                                        <option value="<?php echo $mh->menu_id ?>"><?php echo $mh->name ?></option>
                                                    <?php } ?>
                                                    </select>
                                                
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="fa_icon" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Ikon Menu</b> <br />
                                                <i style="font-size:12px;">Tulis ikon menu</i>                          
                                            </label>
                                            <div class="col-sm-3">
                                                <input type="text" name="fa_icon" value="" id="fa_icon" class="form-control"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <?php if (validation_errors()) { ?>
                                                <i style="color:red;margin-bottom:0px;"><?php echo form_error('fa_icon') ?></i>
                                                <?php } ?>  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="order" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Posisi Menu</b> <br />
                                                <i style="font-size:12px;">Tentukan posisi untuk menu yang akan dibuat</i>                          
                                            </label>
                                            <div class="col-sm-2">
                                                <input type="text" name="order" value="" id="order" class="form-control"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <?php if (validation_errors()) { ?>
                                                <i style="color:red;margin-bottom:0px;"><?php echo form_error('order') ?></i>
                                                <?php } ?>  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="active" class="col-sm-3 control-label" style="text-align:left">
                                                <b style="text-align:right;">Status Aktif Menu</b> <br />
                                                <i style="font-size:12px;">Aktifkan jika menu yang akan dibuat memiliki status aktif</i>                          
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="active" name="active" data-toggle="toggle" data-width="70" data-height="33" data-on="Ya" data-off="Tidak">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/menus', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
