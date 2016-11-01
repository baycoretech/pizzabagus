<head>
	<meta charset="utf-8" />
	<title>Creatify | Create Your Creative Website with Creatify</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Create Your Creative Website with Creatify" name="description" />
	<meta content="Creati Web Design" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?php echo MADMINURL ?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/animate.min.css" rel="stylesheet" />
	<?php
		if(($section == 'logo' || $section == 'favicon' || $section == 'profile' || $section == 'page' || $section == 'users' || $section == 'slider') && ($action == 'add' || $action == 'edit' || $id == 'add' || $id == 'add-image' || $id == 'edit')) {
	?>
	<link href="<?php echo MADMINURL ?>assets/css/crop-avatar.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/cropper.min.css" rel="stylesheet" />
	<?php } ?>
	<link href="<?php echo MADMINURL ?>assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="<?php echo MADMINURL ?>assets/css/custom.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?php echo MADMINURL ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/monthly/css/monthly.css" rel="stylesheet" />
    <?php
		if($section == "coloring") {
	?>
    <link href="<?php echo MADMINURL ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <?php
    	}
    ?>
    <?php 
		if($section == "home-page-style") {
	?>
    <link href="<?php echo MADMINURL ?>assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <?php
    	}
		if($section == "page" && (($id == "view")) || ($id == "view-name-asc") || ($id == "view-name-desc") || ($id == "view-date-asc")) {
	?>
    <link href="<?php echo MADMINURL ?>assets/plugins/isotope/isotope.css" rel="stylesheet" />
  	<link href="<?php echo MADMINURL ?>assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
  	<?php
  		}
		if($section == "invoice") {
	?>
	<link href="<?php echo MADMINURL ?>assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/css/invoice-print.min.css" rel="stylesheet" />
    <?php 
    	}
    ?>
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo MADMINURL ?>assets/js/modernizr.custom.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/pace/pace.min.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/moment/moment.min.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.env.isCompatible = true;
	</script>
	<!-- Favicon -->
	<?php
		if($function_view_favicon == false) {
	?>
	<link rel="shortcut icon" href="<?php echo MURL.'cr-include/images/favicon.png' ?>">
	<?php
		}
		else {
	?>
	<link rel="shortcut icon" href="<?php echo MURL.'cr-editor/_thumbs/Images/'.$function_view_favicon->cr_settingValue ?>">
	<?php } ?>
</head>