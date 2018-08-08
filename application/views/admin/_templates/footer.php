<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <footer class="main-footer no-print">
                <div class="pull-right hidden-xs">

                </div>
                <strong><?php echo lang('footer_copyright'); ?> &copy; <?php echo date('Y'); ?> <a href="" target="_blank"><?php echo $kud->nama_kud ?></a>.</strong>
            </footer>
        </div>


        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/slimscroll/slimscroll.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/datatables-bs/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/datatables-bs/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/datatables-bs/dataTables.checkboxes.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/bootstrap-toggle/js/bootstrap2-toggle.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/imagerjs/imagerJs.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/bootbox/bootbox.min.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/jquery-price-format/jquery.priceformat.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/jstepper/jquery.jstepper.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/moment/moment-with-locales.js'); ?>"></script>
          <script src="<?php base_url($plugins_dir . '/datepicker/datepicker.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/xzoom/js/xzoom.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/xzoom/fancybox/source/jquery.fancybox.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/xzoom/magnific-popup/js/magnific-popup.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/xzoom/js/foundation.min.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/xzoom/js/setup.js'); ?>"></script>
          <script src="<?php echo base_url($plugins_dir . '/bootstrap-maxlength/bootstrap-maxlength.js'); ?>"></script>
<?php if ($mobile == TRUE): ?>
        <script src="<?php echo base_url($plugins_dir . '/fastclick/fastclick.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($admin_prefs['transition_page'] == TRUE): ?>
        <script src="<?php echo base_url($plugins_dir . '/animsition/animsition.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <script src="<?php echo base_url($plugins_dir . '/tinycolor/tinycolor.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.js'); ?>"></script>
<?php endif; ?>
        <script src="<?php echo base_url($frameworks_dir . '/adminlte/js/adminlte.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/domprojects/js/dp.min.js'); ?>"></script>


        <script src="<?php echo base_url($plugins_dir . '/uploadimages/uploadImages.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/jquery-input-count/js/jquery-input-char-count.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/froala-editor/js/froala_editor.pkgd.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/froala-editor/js/plugins/char_counter.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/sweetalert/sweetalert2.all.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/jquery-price-format/jquery.priceformat.js'); ?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
        $('.sidebar-menu a[href~="' + location.href + '"]').parents('li').addClass('active');
       var mytable = $("#datad_table").DataTable({

            columnDefs: [
                {
                    targets: 0,
                    checkboxes: {
                        seletRow: true
                    }
                }
            ],
            select:{
                style: 'multi'
            },
            order: [[1, 'asc']]
        })
    })

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format:'yyyy-mm-dd',
      endDate: '+0d'
    })

    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format:'yyyy-mm-dd',
      endDate: '+0d',

    })

</script>

    </body>
</html>
