<?php
	$class_appearance      = new Appearance($pdo);
    $function_view_favicon = $class_appearance->view_favicon();
?>
<head>
	<meta charset="utf-8" />
	<title>Creatify | Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?php echo MADMINURL ?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo MADMINURL ?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<!-- ================== FAVICON ================== -->
	<?php
		if($function_view_favicon == false) {
	?>
	<link rel="shortcut icon" href="<?php echo MURL.'cr-include/images/favicon.png' ?>">
	<?php
		}
		else {
	?>
	<link rel="shortcut icon" href="<?php echo MURL.$function_view_favicon->cr_settingValue ?>">
	<?php } ?>
</head>