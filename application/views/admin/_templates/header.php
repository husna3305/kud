<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="<?php echo $charset; ?>">
        <title><?php echo $kud->nama_kud ?></title>
        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>

<?php if ($mobile === FALSE): ?>
        <!--[if IE 8]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
<?php else: ?>
        <meta name="HandheldFriendly" content="true">
<?php endif; ?>
<?php if ($mobile == TRUE && $mobile_ie == TRUE): ?>
        <meta http-equiv="cleartype" content="on">
<?php endif; ?>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">
<?php if ($mobile == TRUE && $ios == TRUE): ?>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="<?php echo $title; ?>">
<?php endif; ?>
<?php if ($mobile == TRUE && $android == TRUE): ?>
        <meta name="mobile-web-app-capable" content="yes">
<?php endif; ?>
        <link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAqElEQVRYR+2WYQ6AIAiF8W7cq7oXd6v5I2eYAw2nbfivYq+vtwcUgB1EPPNbRBR4Tby2qivErYRvaEnPAdyB5AAi7gCwvSUeAA4iis/TkcKl1csBHu3HQXg7KgBUegVA7UW9AJKeA6znQKULoDcDkt46bahdHtZ1Por/54B2xmuz0uwA3wFfd0Y3gDTjhzvgANMdkGb8yAyY/ro1d4H2y7R1DuAOTHfgAn2CtjCe07uwAAAAAElFTkSuQmCC">

        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/fontawesome-all.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/ionicons/css/ionicons.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/skins/skin-blue.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/datatables-bs/dataTables.bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/datatables-bs/dataTables.checkboxes.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/bootstrap-toggle/css/bootstrap2-toggle.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/imagerjs/imagerJs.css'); ?>">
<?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/animsition/animsition.min.css'); ?>">
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.css'); ?>">
<?php endif; ?>
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/domprojects/css/dp.min.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/jquery-input-count/css/jquery-input-char-count-bootstrap3.min.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/froala-editor/css/froala_editor.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/froala-editor/css/froala_style.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/froala-editor/css/plugins/char_counter.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/froala-editor/css/themes/royal.css'); ?>">
          <link rel="stylesheet" href="<?php base_url($plugins_dir . '/datepicker/datepicker.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>">
          
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/xzoom/css/normalize.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/xzoom/css/xzoom.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/xzoom/fancybox/source/jquery.fancybox.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/xzoom/magnific-popup/css/magnific-popup.css'); ?>">
<?php if ($mobile === FALSE): ?>
        <!--[if lt IE 9]>
            <script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
        <![endif]-->
<?php endif; ?>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini" onload="setButton()">
      <div id="loading-status">
   <table>
      <tr>
         <td><img src='<?php echo base_url("assets/img/ajax-loader.gif") ?>' /></td>
         <td>Mohon tunggu...</td>
      </tr>
   </table>
</div>
<?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
        <div class="wrapper animsition">
<?php else: ?>
        <div class="wrapper">
<?php endif; ?>
<style media="screen">
  .has-input-error{
    border-color: #a94442;
  }
</style>
<style type="text/css">
  #loading-status{
   position:fixed;
   top:40%;
   right:40%;
   padding:5px 7px;

   -moz-border-radius: 5px; 
   -webkit-border-radius: 5px;
   z-index:3000;
   display:none;
}
</style>


<script type="text/javascript">
  $(function(){
   $("#loading-status").ajaxStart(function(){
      $(this).show();
   }).ajaxStop(function(){
      $(this).hide();
   });
});
</script>