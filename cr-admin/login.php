<?php
	require __DIR__.'/include/database/connection.php';
    $class_settings    = new Settings($pdo);
	$function_bg_login = $class_settings->view_settings_background_login();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php require 'login-head.php' ?>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image"><img src="<?php if($function_bg_login->cr_settingValue == '') echo MADMINURL.'assets/img/login-bg/bg.jpg'; else echo MURL.'cr-editor/images/'.$function_bg_login->cr_settingValue ?>" data-id="login-cover-image" alt="Background" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <img src="assets/img/logo-creatify.png" height="50">
                    <small>Create Your Creative Website with Creatify</small>
                </div>
                <div class="icon hidden-xs">
                    <i class="material-icons">lock</i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form id="form-sign-in" data-parsley-validate action="" method="POST" class="margin-bottom-0">
                	<div id="error"></div>
                    <div class="form-group m-b-20">
                        <input id="crusername" type="text" class="form-control input-lg" placeholder="Username" name="username" autofocus required />
                    </div>
                    <div class="form-group m-b-20">
                        <input id="crpassword" type="password" class="form-control input-lg" placeholder="Password" name="password" required />
                    </div>
                    <!--<div class="checkbox m-b-20">
                        <label>
                            <input type="checkbox" /> Remember Me
                        </label>
                    </div>-->
                    <div class="login-buttons">
                        <button id="button-sign-in" type="submit" name="cr-login" class="btn btn-success btn-block btn-lg">Sign in</button>
                    </div>
                    	
                    <div class="m-t-20">
                        <i class="fa fa-external-link"></i> View your <a href="<?php echo MURL ?>" target="_blank">website</a>

                        <span class="pull-right"><a href="#modal-forgot-password" data-target="#modal-forgot-password" data-toggle="modal">Forgot password</a></span>
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
        
	</div>
	<!-- end page container -->

	<div class="modal fade" id="modal-forgot-password">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title">Forgot Password</h4>
	            </div>
	            <div class="modal-body">
	            	<div id="error-forgot-password"></div>
	                <p>Please confirm your email.</p>
	                <form id="form-forgot-password" action="" data-parsley-validate action="" method="post">
	                	<div class="form-group">
	                        <input type="email" class="form-control" placeholder="Your Email" name="email" data-parsley-type="email" autofocus required />
	                    </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
	                <button id="button-forgot-password" type="submit" class="btn btn-success">Confirm</button>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	<?php require 'login-script.php' ?>
</body>
</html>