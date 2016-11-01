<?php
    require_once __DIR__.'/../cr-include/error-report.php';
    require_once __DIR__.'/include/database/connection.php';
    require_once __DIR__.'/include/autoloader.php';
    require_once __DIR__.'/include/global-function.php';

    $email = $_GET['e'];
    $token = $_GET['token'];

    $class_appearance = new Appearance($pdo);
    $view_favicon     = $class_appearance->view_favicon();

    $class_administrator  = new Administrator($pdo);
    $verify_administrator = $class_administrator->verify_administrator($token);

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Creatify | Change Password</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?php echo MADMINURL ?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/css/style.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="<?php echo MADMINURL ?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== FAVICON ================== -->
    <?php
        if($view_favicon->cr_settingValue != "") {
    ?>
    <link rel="shortcut icon" href="<?php echo MURL.$view_favicon->cr_settingValue ?>">
    <?php
        }
        else {
    ?>
    <link rel="shortcut icon" href="<?php echo MURL.'cr-include/images/favicon.png' ?>">
    <?php } ?>
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="<?php echo MADMINURL ?>assets/img/login-bg/bg.jpg" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-edit text-success"></i> Change Password for Creatify</h4>
                    <p>
                        Please use a secure password and easy to remember, and keep it save. If you have any other problems please send an email to <a class="text-success" href="mailto:technologiacreativa@gmail.com">technologiacreativa@gmail.com</a>.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin register-header -->
                <h1 class="register-header">
                    Change Password
                    <small>Create your new password here.</small>
                </h1>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
                    <?php 
                        if($verify_administrator == false) {
                    ?>
                        <div class="alert alert-danger fade in">
                            <strong>Error!</strong> You don't have permission to access this page.
                        </div>
                    <?php
                        }
                        else {
                            $md5_email = md5($verify_administrator->cr_adminEmail);
                            if($email == $md5_email) {
                    ?>
                    <form id="form-change-password" data-parsley-validate action="" method="POST" class="margin-bottom-0">
                        <div id="error"></div>
                        <input type="hidden" name="emailuser" value="<?php echo $verify_administrator->cr_adminEmail ?>">
                        <label class="control-label">Password</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input id="samepass" type="password" name="password" class="form-control" placeholder="Password" data-parsley-minlength="6" required />
                            </div>
                        </div>
                        <label class="control-label">Re-enter Password</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="repassword" placeholder="Re-enter Password" data-parsley-equalto="#samepass" required />
                            </div>
                        </div>
                        <div class="register-buttons">
                            <button id="button-change-password" type="submit" class="btn btn-success btn-block btn-lg">Change Password</button>
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Creatify All Right Reserved 2016
                        </p>
                    </form>
                    <?php
                            }
                            else {
                    ?>
                        <div class="alert alert-danger fade in">
                            <strong>Error!</strong> You don't have permission to access this page.
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
        
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?php echo MADMINURL ?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?php echo MADMINURL ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo MADMINURL ?>assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo MADMINURL ?>assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo MADMINURL ?>assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
    <script src="<?php echo MADMINURL ?>assets/plugins/parsley/dist/parsley.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo MADMINURL ?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo MADMINURL ?>assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(document).ready(function() {
			App.init();
            var change_password;
            $("#form-change-password").submit(function(event){
                if ($(this).parsley().isValid()) {
                    if (change_password) {
                        change_password.abort();
                    }
                    var $form = $(this);
                    var $inputs = $form.find("input, button");
                    var serializedData = $form.serialize();
                    change_password = $.ajax({
                        url: "<?php echo MADMINURL ?>ajax/change-password.php",
                        type: "post",
                        beforeSend: function(){ $("#button-change-password").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-change-password").attr('disabled','disabled');},
                        data: serializedData
                    });
                    change_password.done(function (msg){
                        if(msg == 'empty-field') {
                            $("#button-change-password").removeAttr('disabled');
                            $("#button-change-password").html('Change Password');
                            $("#error").html('<div class="alert alert-danger fade in"><strong>Failed!</strong> Please fill all required field and try again.</div>');
                        }
                        else if(msg == 'error-email') {
                            $("#button-add-page").removeAttr('disabled');
                            $("#button-add-page").html('Change Password');
                            $("#error").html('<div class="alert alert-danger fade in"><strong>Failed!</strong> Email has been changed, but can\'t send login information to your email.</div>');
                        }
                        else if(msg == 'true') {
                            $("#error").html('<div class="alert alert-success fade in"><strong>Success!</strong> We have change your password and send your login information to your email. This page will redirect to Creatify login page in 2 seconds.</div>');
                            $("#button-add-page").html('Change Password');
                             setTimeout(function(){
                                window.location="<?php echo MADMINURL ?>";
                            }, 2000);
                        }
                        else if(msg == 'error') {
                            $("#button-change-password").removeAttr('disabled');
                            $("#button-change-password").html('Change Password');
                            $("#error").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Can\'t change password. Please try again.</div>');
                        }
                        else if(msg == 'notsame') {
                            $("#button-change-password").removeAttr('disabled');
                            $("#button-change-password").html('Change Password');
                            $("#error").html('<div class="alert alert-danger fade in"><strong>Failed!</strong> The passwords are not equal. Please try again.</div>');
                        }
                        else {
                            $("#button-change-password").removeAttr('disabled');
                            $("#button-change-password").html('Change Password');
                            $("#error").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Can\'t change password. Please try again.</div>');
                        }
                    });
                    change_password.always(function () {
                        $inputs.prop("disabled", false);
                    });
                    event.preventDefault();
                }
            });
		});
	</script>
</body>
</html>
