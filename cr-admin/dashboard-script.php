<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
	<script src="http://html5shiv-printshiv.googlecode.com/svn/trunk/html5shiv-printshiv.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<script src="https://code.google.com/p/flot/source/browse/trunk/excanvas.min.js?r=151"></script>
<![endif]-->
<script src="<?php echo MADMINURL ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo MADMINURL ?>assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/masked-input/masked-input.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/js/jquery.runner-min.js"></script>
<script src="<?php echo MADMINURL ?>assets/js/readmore.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/initial/initial.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/monthly/js/monthly.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/js/dataTables.colVis.js"></script>
<?php
	if($section == "invoice") {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<?php
	}
	if($section == "disk-usage") {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/jstree/dist/jstree.min.js"></script>
<?php
	}
	if($section == "custom-css") {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-ace/jquery-ace.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-ace/ace/ace.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-ace/ace/theme-github.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-ace/ace/mode-css.js"></script>
<?php
	}
	if($section == "social") {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/instafeed/instafeed.min.js"></script>
<?php
	}
	if((($section == 'logo' || $section == 'favicon' || $section == 'profile' || $section == 'users' || $section == 'slider') && ($action == 'add' || $action == 'edit')) || $section == 'page' && (($page_type == 'portfolio' || $page_type == 'blog' || $page_type == 'menu') && ($id == 'add' || $id == 'add-image' || $id == 'edit'))) {
?>
<script src="<?php echo MADMINURL ?>assets/js/cropper.min.js"></script>
<?php
	}
	if(($section == 'profile' && $action == 'edit') || $section == 'users' && ($action == 'add' || $action == 'edit') || $section == 'customers' && ($action == 'add' || $action == 'edit')) {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/hideshowpassword/hideShowPassword.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/pwstrength/pwstrength.js"></script>
<?php
	}
?>
<script src="<?php echo MADMINURL ?>assets/js/livestamp.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/js/html5lightbox.js"></script>
<?php
	if(($section == "page" && ($page_type == 'portfolio' || $page_type == 'general')) || $section  == 'media') {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/dropzone/dropzone.js"></script>
<?php 
	}
	if($section == "coloring") {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<?php
	}
?>
<?php 
	if($section == "home-page-style") {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
<script src="<?php echo MADMINURL ?>assets/js/form-wizards-validation.demo.min.js"></script>
<?php
	}
?>
<?php 
	if($section == "page" && (($id == "view")) || ($id == "view-name-asc") || ($id == "view-name-desc") || ($id == "view-date-asc")) {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/js/gallery.demo.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		Gallery.init();
	});
</script>
<?php
	}
	if($section == "history") {
?>
<script src="<?php echo MADMINURL ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
<?php
	}
?>