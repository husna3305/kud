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
                                    <h3 class="box-title">Apakah anda yakin ingin mengubah status brand <span class="label label-primary"><?php echo $one_brand->name; ?></span></h3>
                                </div>
                                <div class="box-body">
                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-status_user')); ?>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <input type="hidden" name="menu_id" value="<?php echo $id_encode?>"/>
                                                <input type="hidden" name="active" value="<?php echo $one_brand->active ?>"/>
                                                <input type="checkbox" id="prompt" name="prompt" data-toggle="toggle" data-width="80" data-height="33" data-on="Ya" data-off="Tidak">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
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
