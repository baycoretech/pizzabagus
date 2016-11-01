<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/include/database/connection.php';
	$class_general_setting = new General_Setting($pdo);
	$function_folder_name  = $class_general_setting->folder_name();
	$host         = "$_SERVER[HTTP_HOST]";
    $explode_url  = explode('/', $_SERVER[REQUEST_URI]);
    $router       = new AltoRouter();
    if($function_folder_name != "0") {
        $router->setBasePath('/'.$function_folder_name);
    }
	require __DIR__.'/../cr-include/routes.php';

	//Session login
	$admin_id_session   = $_SESSION['cr_adminID'];
    $admin_pass_session = $_SESSION['cr_adminPassword'];
    $redirect_to_login  = $router->generate('admin-login');

    if(empty($admin_id_session) && empty($admin_pass_session)) {
    	header("location:$redirect_to_login");
    }
    else {

	    //Set ABSOLUTE URL as variable for header redirect
	    $master_admin_url = MADMINURL;
	    $master_url       = MURL;

	    $class_administrator            = new Administrator($pdo);
		$function_profile_administrator = $class_administrator->profile_administrator($admin_id_session);
		$admin_display    = $function_profile_administrator->cr_adminDisplayName;
		$admin_level      = $function_profile_administrator->cr_adminLevel;
		$admin_photo      = $function_profile_administrator->cr_adminPhoto;
		$admin_last_login = $function_profile_administrator->cr_adminLastlogin;

		$class_administrative  = new Administrative($pdo);
		$class_settings        = new Settings($pdo);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Creatify | Create Your Creative Website with Creatify</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Create Your Creative Website with Creatify" name="description" />
	<meta content="Technologia Creativa Bali" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?php echo MADMINURL ?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="<?php echo MADMINURL ?>assets/css/themes-preview.css" rel="stylesheet" />

	<script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo MADMINURL ?>assets/js/modernizr.custom.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/pace/pace.min.js"></script>

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

<body>
	<div id="header" class="header navbar navbar-default navbar-fixed-top">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin mobile sidebar expand / collapse button -->
			<div class="navbar-header">
				<a href="<?php echo $router->generate('admin-dashboard') ?>" class="navbar-brand"><img src="<?php echo MADMINURL; ?>assets/img/logo-creatify.png" height="35"></a>
			</div>
			<!-- end mobile sidebar expand / collapse button -->
					
			<!-- begin header navigation right -->
			<ul class="nav navbar-nav navbar-right" id="viewport-select">
			    <li>
	                <a href="" class="icon waves-effect waves-light" data-responsiveness="mobile"><i class="material-icons">phone_android</i></a>
	            </li>
	            <li>
	                <a href="" class="icon waves-effect waves-light" data-responsiveness="tablet"><i class="material-icons">tablet_android</i></a>
	            </li>
	            <li class="active">
	                <a href="" class="icon waves-effect waves-light" data-responsiveness="desktop"><i class="material-icons">desktop_windows</i></a>
	            </li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end container-fluid -->
	</div>

	<div id="themes-preview" class="desktop"></div>

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
	<script type="text/javascript">
		$(document).ready(function() {
	        $("#themes-preview").html('<object data="<?php echo MURL ?>"/>');

	        $("#viewport-select li a").click(function() {
	        	var responsiveness = $(this).data('responsiveness');
	        	$("#viewport-select li").removeClass('active');
	        	$(this).parent().addClass('active');
	        	$("#themes-preview").removeAttr("class");
	        	$("#themes-preview").attr("class",responsiveness);
	            return false;
	        })
	    })
	</script>
</body>
<?php } ?>