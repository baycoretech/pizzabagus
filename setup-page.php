<?php
	require __DIR__.'/cr-include/error-report.php';
  	header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
	header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );

	$array_file    = file(__DIR__.'/cr-include/database/database.php');
	$array_line    = $array_file[0];
	$explode_line  = explode(',', $array_line);
	$database_name = $explode_line[0];

	if($database_name != '') {
		if(!isset($step)) { 
			$server_name  = $_SERVER['SERVER_NAME'];
	        if($server_name == 'localhost') {
	            $explode_url  = explode('/', $_SERVER['REQUEST_URI']);
	            $subfolder    = $explode_url[1];
	            $header =  "http://$_SERVER[SERVER_NAME]".'/'.$subfolder.'/404.php';
	            header("location: $header"); 
	        }
	        else {
	        	if(dirname($_SERVER['PHP_SELF']) == '/') {
		            $header = "http://$_SERVER[SERVER_NAME]/404.php";
		            header("location: $header"); 
		        }
		        else {
		        	$subfolder = str_replace("/", "", dirname($_SERVER['PHP_SELF']));
		        	$header =  "http://$_SERVER[SERVER_NAME]".'/'.$subfolder.'/404.php';
	            	header("location: $header"); 
		        }
	        }
		}
		else {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Creatify | Setup Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/animate.min.css" rel="stylesheet" />

	<link href="<?php echo script_namespace() ?>/cr-include/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/parsley/src/parsley.css" rel="stylesheet" id="theme" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/setup-page-step.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/setup-page.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader">
	    <div class="material-loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
            <div class="message">Loading...</div>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="<?php echo script_namespace() ?>/cr-include/images/bg.jpg" data-id="login-cover-image" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title">
                    	<i class="material-icons text-cyan pull-left m-r-5">apps</i> 
                    	Get Started with Creatify - <?php if(isset($step)) { if($step == '2') echo 'Site Name and Admin Data'; elseif($step == '3') echo 'Complete'; } else { echo 'Database'; } ?>
                    </h4>
                    <p>
                        Setup your website with three easy steps.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <img src="<?php echo script_namespace() ?>/cr-include/images/logo-creatify.png" height="50">
                    	<small>Create Your Creative Website with Creatify</small>
                    </div>
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                <?php
                	if($step == '2') {
                ?>
                	<form id="form-sitename-admin-setup" action="" method="POST" class="margin-bottom-0" data-parsley-validate>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Site Name" name="site_name" required/>
                        </div>
                        <div class="form-group m-b-15">
                            <select class="form-control input-lg" name="site_url" required>
	                        	<option value="">Select URL Type</option>
	                        	<option value="http://">http://</option>
	                        	<option value="https://">https://</option>
	                        </select>
	                        <p class="help-block small">Select URL type, standard or secure.</p>
                        </div>
                        <div class="form-group m-b-15">
                        	<input type="text" class="form-control input-lg" placeholder="Folder Name" name="folder_name" />
                        	<p class="help-block small">If you are running Creatify on a subfolder or localhost, fill it with the folder name. Otherwise, leave it empty.</p>
                        </div>
                        <div class="form-group m-b-15">
	                        <input type="text" class="form-control input-lg" placeholder="Username" name="admin_username" data-parsley-minlength="6" data-parsley-maxlength="100" required />
	                    </div>
	                    <div id="pwd-container" class="form-group m-b-15">
	                        <input id="same-password" type="password" class="form-control input-lg" placeholder="Password" name="admin_password" data-parsley-minlength="6" required />
	                        <!--<div id="password-strength" class="is0 m-t-5"></div>-->
	                        <div class="pwstrength-viewport-progress"></div>
	                    </div>
	                    <div class="form-group m-b-15">
	                        <input type="password" class="form-control input-lg" placeholder="Password Repeat" name="repeat_password" data-parsley-equalto="#same-password" required />
	                    </div>
	                    <div class="form-group m-b-15">
	                        <input type="email" class="form-control input-lg" placeholder="Email" name="admin_email" required />
	                    </div>
                        <div class="login-buttons">
                            <button id="button-sitename-admin-setup" type="submit" class="btn btn-success btn-block btn-lg">Next</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Please read our <a class="text-success" href="">documentation</a> for more information. 
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Technologia Creativa. All Right Reserved 2016
                        </p>
                    </form>
                <?php
                	}
                	elseif($step == '3') {
                		require __DIR__.'/cr-include/database/connection.php';
                		require __DIR__.'/cr-include/autoloader.php';
                		require __DIR__.'/cr-include/global-function.php';
                		$class_setup_page    = new Setup_Page($pdo);
                		$function_last_setup = $class_setup_page->last_setup();
                ?>
	                <dl class="dl-horizontal">
						<dt>Username</dt>
						  	<dd>: <?php echo $function_last_setup->cr_adminUsername; ?></dd>
						<dt>Password</dt>
						  	<dd>: <em>Your chosen password</em></dd>
					</dl>
					<p>Your login information has been sent to your email.</p>
					<div class="login-buttons">
                        <button type="button" onClick="location.href='<?php echo MADMINURL ?>'" name="btn-step3" class="btn btn-success btn-block btn-lg">Start Creatify </button>
                    </div>
                <?php
                	}
                	else {
                ?>
                    <form id="form-database-setup" action="" method="POST" class="margin-bottom-0" data-parsley-validate>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Database Name" name="database_name" data-parsley-type="alphanum" required/>
                        </div>
                        <?php
                        	if($_SERVER['SERVER_NAME'] == 'localhost') {
                        ?>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Username" name="database_username" required/>
                        </div>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Password" name="database_password" />
                            <p class="help-block small">Leave password empty if your server has no password.
                            </p>
                        </div>
                        <?php
                        	}
                        ?>
                        <!--
                        <div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" /> Remember Me
                            </label>
                        </div>
                        -->
                        <div class="login-buttons">
                            <button id="button-database-setup" type="submit" class="btn btn-success btn-block btn-lg">Next</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Please read our <a class="text-success" href="">documentation</a> for more information. 
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Technologia Creativa. All Right Reserved 2016
                        </p>
                    </form>
                <?php
                	}
                ?>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->
	
	<div class="modal modal-message fade in" id="modal-message">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Error</h4>
				</div>
				<div class="modal-body">
					<p id="error-message"></p>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
				</div>
			</div>
		</div>
	</div>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
		<script src="cr-include/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/parsley/dist/parsley.js"></script>
	<?php
		if($step == '2') {
	?>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/pwstrength/pwstrength.js"></script>
	<?php 
		}
	?>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo script_namespace() ?>/cr-include/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(document).ready(function() {
			App.init();
			<?php 
				if(!isset($step)) {
			?>
			var database_setup;
			$("#form-database-setup").submit(function(event){
			    if (database_setup) {
			        database_setup.abort();
			    }
			    var $form = $(this);
			    var serializedData = $form.serialize();
			    database_setup = $.ajax({
			        url: "<?php echo script_namespace() ?>/cr-include/database-setup.php",
			        type: "post",
			        beforeSend: function(){ $("#button-database-setup").html('<i class="fa fa-spinner fa-pulse"></i> Processing...');$("#button-database-setup").attr('disabled','disabled');},
			        data: serializedData
			    });
			    database_setup.done(function (msg){
			        if(msg == 'success') {
			         window.location = "<?php
			         	$server_name  = $_SERVER['SERVER_NAME'];
				        if($server_name == 'localhost') {
				            $explode_url  = explode('/', $_SERVER['REQUEST_URI']);
				            $subfolder    = $explode_url[1];
				            echo '/'.$subfolder.'/setup/step/2/';
				        }
				        else {
				        	if(dirname($_SERVER['PHP_SELF']) == '/') {
				            	echo '/setup/step/2/';
					        }
					        else {
					        	$subfolder = str_replace("/", "", dirname($_SERVER['PHP_SELF']));
				            	echo '/'.$subfolder.'/setup/step/2/';
					        }
				        } 
			         ?>";
			        }
			        else if(msg == 'empty-field') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Please fill the required field and try again.');
			        }
			        else if(msg == 'failed') {
			          	$("#button-database-setup").removeAttr('disabled');
						$("#button-database-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Can\'t get you to the next step. Please try again.');
			        }
			        else {
			            $("#button-database-setup").removeAttr('disabled');
						$("#button-database-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Error. Can\'t get you to the next step. Please try again.');
						console.log(msg);
			        }
			    });
			    event.preventDefault();
			});
			<?php
				}
				else {
					if($step == '2') {
			?>
			var sitename_admin_setup;
			$("#form-sitename-admin-setup").submit(function(event){
			    if (sitename_admin_setup) {
			        sitename_admin_setup.abort();
			    }
			    var $form = $(this);
			    var serializedData = $form.serialize();
			    sitename_admin_setup = $.ajax({
			        url: "<?php echo script_namespace() ?>/cr-include/sitename-admindata-setup.php",
			        type: "post",
			        beforeSend: function(){ $("#button-sitename-admin-setup").html('<i class="fa fa-spinner fa-pulse"></i> Processing...');$("#button-sitename-admin-setup").attr('disabled','disabled');},
			        data: serializedData
			    });
			    sitename_admin_setup.done(function (msg){
			        if(msg == 'success') {
			         window.location = "<?php
			         	$server_name  = $_SERVER['SERVER_NAME'];
				        if($server_name == 'localhost') {
				            $explode_url  = explode('/', $_SERVER['REQUEST_URI']);
				            $subfolder    = $explode_url[1];
				            echo '/'.$subfolder.'/setup/step/3/';
				        }
				        else {
				            if(dirname($_SERVER['PHP_SELF']) == '/') {
				            	echo '/setup/step/3/';
					        }
					        else {
					        	$subfolder = str_replace("/", "", dirname($_SERVER['PHP_SELF']));
				            	echo '/'.$subfolder.'/setup/step/3/';
					        }
				        } 
			         ?>";
			        }
			        else if(msg == 'empty-field') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Please fill the required field and try again.');
			        }
			        else if(msg == 'mismatch-password') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Password and repeat password is not identic. Please try again.');
			        }
			        else if(msg == 'mail-failed') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Can\'t send setup information to your email.');
			        }
			        else if(msg == 'failed') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Can\'t get you to the next step. Please try again.');
			        }
			        else {
			            $("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html(msg);
			        }
			    });
			    event.preventDefault();
			});
			<?php
					}
				}
			?>
		});
	</script>
	<?php
		if($step == '2') {
	?>
	<script type="text/javascript">
        $(document).ready(function () {
            "use strict";
            var options = {};
            options.ui = {
                container: "#pwd-container",
                showVerdictsInsideProgressBar: true,
                viewports: {
                    progress: ".pwstrength-viewport-progress"
                }
            };
            options.common = {
                debug: true
            };
            $('#same-password').pwstrength(options);
        });
    </script>
	<?php
		}
	?>
</body>
</html>
<?php
		}
	}
	else {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Creatify | Setup Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/animate.min.css" rel="stylesheet" />

	<link href="<?php echo script_namespace() ?>/cr-include/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/parsley/src/parsley.css" rel="stylesheet" id="theme" />
	<link href="<?php echo script_namespace() ?>/cr-include/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/setup-page-step.css" rel="stylesheet" />
	<link href="<?php echo script_namespace() ?>/cr-include/css/setup-page.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader">
	    <div class="material-loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
            <div class="message">Loading...</div>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="<?php echo script_namespace() ?>/cr-include/images/bg.jpg" data-id="login-cover-image" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title">
                    	<i class="material-icons text-cyan pull-left m-r-5">apps</i> 
                    	Get Started with Creatify - <?php if(isset($step)) { if($step == '2') echo 'Site Name and Admin Data'; elseif($step == '3') echo 'Complete'; } else { echo 'Database'; } ?>
                    </h4>
                    <p>
                        Setup your website with three easy steps.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <img src="<?php echo script_namespace() ?>/cr-include/images/logo-creatify.png" height="50">
                    	<small>Create Your Creative Website with Creatify</small>
                    </div>
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                <?php
                	if($step == '2') {
                ?>
                	<form id="form-sitename-admin-setup" action="" method="POST" class="margin-bottom-0" data-parsley-validate>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Site Name" name="site_name" required/>
                        </div>
                        <div class="form-group m-b-15">
                            <select class="form-control input-lg" name="site_url" required>
	                        	<option value="">Select URL Type</option>
	                        	<option value="http://">http://</option>
	                        	<option value="https://">https://</option>
	                        </select>
	                        <p class="help-block small">Select URL type, standard or secure.</p>
                        </div>
                        <div class="form-group m-b-15">
                        	<input type="text" class="form-control input-lg" placeholder="Folder Name" name="folder_name" />
                        	<p class="help-block small">If you are running Creatify on a subfolder or localhost, fill it with the folder name. Otherwise, leave it empty.</p>
                        </div>
                        <div class="form-group m-b-15">
	                        <input type="text" class="form-control input-lg" placeholder="Username" name="admin_username" data-parsley-minlength="6" data-parsley-maxlength="100" required />
	                    </div>
	                    <div id="pwd-container" class="form-group m-b-15">
	                        <input id="same-password" type="password" class="form-control input-lg" placeholder="Password" name="admin_password" data-parsley-minlength="6" required />
	                        <!--<div id="password-strength" class="is0 m-t-5"></div>-->
	                        <div class="pwstrength-viewport-progress"></div>
	                    </div>
	                    <div class="form-group m-b-15">
	                        <input type="password" class="form-control input-lg" placeholder="Password Repeat" name="repeat_password" data-parsley-equalto="#same-password" required />
	                    </div>
	                    <div class="form-group m-b-15">
	                        <input type="email" class="form-control input-lg" placeholder="Email" name="admin_email" required />
	                    </div>
                        <div class="login-buttons">
                            <button id="button-sitename-admin-setup" type="submit" class="btn btn-success btn-block btn-lg">Next</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Please read our <a class="text-success" href="">documentation</a> for more information. 
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Technologia Creativa. All Right Reserved 2016
                        </p>
                    </form>
                <?php
                	}
                	elseif($step == '3') {
                		require __DIR__.'/cr-include/database/connection.php';
                		require __DIR__.'/cr-include/autoloader.php';
                		require __DIR__.'/cr-include/global-function.php';
                		$class_setup_page    = new Setup_Page($pdo);
                		$function_last_setup = $class_setup_page->last_setup();
                ?>
	                <dl class="dl-horizontal">
						<dt>Username</dt>
						  	<dd>: <?php echo $function_last_setup->cr_adminUsername; ?></dd>
						<dt>Password</dt>
						  	<dd>: <em>Your chosen password</em></dd>
					</dl>
					<p>Your login information has been sent to your email.</p>
					<div class="login-buttons">
                        <button type="button" onClick="location.href='<?php echo MADMINURL ?>'" name="btn-step3" class="btn btn-success btn-block btn-lg">Start Creatify </button>
                    </div>
                <?php
                	}
                	else {
                ?>
                    <form id="form-database-setup" action="" method="POST" class="margin-bottom-0" data-parsley-validate>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Database Name" name="database_name" data-parsley-type="alphanum" required/>
                        </div>
                        <?php
                        	if($_SERVER['SERVER_NAME'] == 'localhost') {
                        ?>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Username" name="database_username" required/>
                        </div>
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Password" name="database_password" />
                            <p class="help-block small">Leave password empty if your server has no password.
                            </p>
                        </div>
                        <?php } ?>
                        <!--
                        <div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" /> Remember Me
                            </label>
                        </div>
                        -->
                        <div class="login-buttons">
                            <button id="button-database-setup" type="submit" class="btn btn-success btn-block btn-lg">Next</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Please read our <a class="text-success" href="">documentation</a> for more information. 
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Technologia Creativa. All Right Reserved 2016
                        </p>
                    </form>
                <?php
                	}
                ?>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->
	
	<div class="modal modal-message fade in" id="modal-message">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Error</h4>
				</div>
				<div class="modal-body">
					<p id="error-message"></p>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
				</div>
			</div>
		</div>
	</div>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
		<script src="cr-include/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/parsley/dist/parsley.js"></script>
	<?php
		if($step == '2') {
	?>
	<script src="<?php echo script_namespace() ?>/cr-include/plugins/pwstrength/pwstrength.js"></script>
	<?php 
		}
	?>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo script_namespace() ?>/cr-include/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(document).ready(function() {
			App.init();
			<?php 
				if(!isset($step)) {
			?>
			var database_setup;
			$("#form-database-setup").submit(function(event){
			    if (database_setup) {
			        database_setup.abort();
			    }
			    var $form = $(this);
			    var serializedData = $form.serialize();
			    database_setup = $.ajax({
			        url: "<?php echo script_namespace() ?>/cr-include/database-setup.php",
			        type: "post",
			        beforeSend: function(){ $("#button-database-setup").html('<i class="fa fa-spinner fa-pulse"></i> Processing...');$("#button-database-setup").attr('disabled','disabled');},
			        data: serializedData
			    });
			    database_setup.done(function (msg){
			        if(msg == 'success') {
			         window.location = "<?php
			         	$server_name  = $_SERVER['SERVER_NAME'];
				        if($server_name == 'localhost') {
				            $explode_url  = explode('/', $_SERVER['REQUEST_URI']);
				            $subfolder    = $explode_url[1];
				            echo '/'.$subfolder.'/setup/step/2/';
				        }
				        else {
				            if(dirname($_SERVER['PHP_SELF']) == '/') {
				            	echo '/setup/step/2/';
					        }
					        else {
					        	$subfolder = str_replace("/", "", dirname($_SERVER['PHP_SELF']));
				            	echo '/'.$subfolder.'/setup/step/2/';
					        }
				        } 
			         ?>";
			        }
			        else if(msg == 'empty-field') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Please fill the required field and try again.');
			        }
			        else if(msg == 'failed') {
			          	$("#button-database-setup").removeAttr('disabled');
						$("#button-database-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Can\'t get you to the next step. Please try again.');
			        }
			        else {
			            $("#button-database-setup").removeAttr('disabled');
						$("#button-database-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Error. Can\'t get you to the next step. Please try again.');
						console.log(msg);
			        }
			    });
			    event.preventDefault();
			});
			<?php
				}
				else {
					if($step == '2') {
			?>
			var sitename_admin_setup;
			$("#form-sitename-admin-setup").submit(function(event){
			    if (sitename_admin_setup) {
			        sitename_admin_setup.abort();
			    }
			    var $form = $(this);
			    var serializedData = $form.serialize();
			    sitename_admin_setup = $.ajax({
			        url: "<?php echo script_namespace() ?>/cr-include/sitename-admindata-setup.php",
			        type: "post",
			        beforeSend: function(){ $("#button-sitename-admin-setup").html('<i class="fa fa-spinner fa-pulse"></i> Processing...');$("#button-sitename-admin-setup").attr('disabled','disabled');},
			        data: serializedData
			    });
			    sitename_admin_setup.done(function (msg){
			        if(msg == 'success') {
			         window.location = "<?php
			         	$server_name  = $_SERVER['SERVER_NAME'];
				        if($server_name == 'localhost') {
				            $explode_url  = explode('/', $_SERVER['REQUEST_URI']);
				            $subfolder    = $explode_url[1];
				            echo '/'.$subfolder.'/setup/step/3/';
				        }
				        else {
				            if(dirname($_SERVER['PHP_SELF']) == '/') {
				            	echo '/setup/step/3/';
					        }
					        else {
					        	$subfolder = str_replace("/", "", dirname($_SERVER['PHP_SELF']));
				            	echo '/'.$subfolder.'/setup/step/3/';
					        }
				        } 
			         ?>";
			        }
			        else if(msg == 'empty-field') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Please fill the required field and try again.');
			        }
			        else if(msg == 'mismatch-password') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Password and repeat password is not identic. Please try again.');
			        }
			        else if(msg == 'mail-failed') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Can\'t send setup information to your email.');
			        }
			        else if(msg == 'failed') {
			          	$("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html('Failed. Can\'t get you to the next step. Please try again.');
			        }
			        else {
			            $("#button-sitename-admin-setup").removeAttr('disabled');
						$("#button-sitename-admin-setup").html('Next');
						$("#modal-message").modal('show');
						$('#error-message').html(msg);
			        }
			    });
			    event.preventDefault();
			});
			<?php
					}
				}
			?>
		});
	</script>
	<?php
		if($step == '2') {
	?>
	<script type="text/javascript">
        $(document).ready(function () {
            "use strict";
            var options = {};
            options.ui = {
                container: "#pwd-container",
                showVerdictsInsideProgressBar: true,
                viewports: {
                    progress: ".pwstrength-viewport-progress"
                }
            };
            options.common = {
                debug: true
            };
            $('#same-password').pwstrength(options);
        });
    </script>
	<?php
		}
	?>
</body>
</html>
<?php } ?>