<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/js/jquery.ui.shake.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<script src="assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo MADMINURL ?>assets/plugins/parsley/dist/parsley.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo MADMINURL ?>assets/js/login-v2.demo.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
	$(document).ready(function() {
		App.init();
		LoginV2.init();
		var sign_in;
		$("#form-sign-in").submit(function(event){
			if(sign_in) {
			    sign_in.abort();
			}
			var $form = $(this);
			var serializedData = $form.serialize();
			sign_in = $.ajax({
			    url: "<?php echo MADMINURL ?>ajax/user-sign-in.php",
			    type: "post",
			    beforeSend: function(){ $("#button-sign-in").html('<i class="fa fa-spinner fa-pulse"></i> Signing in...');$("#button-sign-in").attr('disabled','disabled');},
			    data: serializedData
			});
			sign_in.done(function (msg){
			    if(msg == 'true') {
			      	window.location = "<?php echo MADMINURL ?>dashboard/";
			    }
			    else if(msg == 'false') {
			    	$('.login-content').shake();
			      	$("#button-sign-in").removeAttr('disabled');
					$("#button-sign-in").html('Sign in');
					$("#error").html('<div class="alert alert-danger fade in"><strong>Failed!</strong> Invalid username or password.</div>');
			    }
			    else {
			      	$('.login-content').shake();
			      	$("#button-sign-in").removeAttr('disabled');
					$("#button-sign-in").html('Sign in');
					//$("#error").html('<div class="alert alert-danger fade in"><strong>Error!</strong> There was an error in the system.</div>');
					$("#error").html(msg);
			    }
			});
			event.preventDefault();
		});

		var forgot_password
		$("#form-forgot-password").submit(function(event){
            if ($(this).parsley().isValid()) {
				if(forgot_password) {
				    forgot_password.abort();
				}
				var $form = $(this);
				var serializedData = $form.serialize();
				forgot_password = $.ajax({
				    url: "<?php echo MADMINURL ?>ajax/forgot-password.php",
				    type: "post",
				    beforeSend: function(){ $("#button-forgot-password").html('<i class="fa fa-spinner fa-pulse"></i> Checking email...');},
				    data: serializedData
				});
				forgot_password.done(function (msg){
					if(msg == 'true') {
				     	$("#error-forgot-password").html('<div class="alert alert-success fade in"><strong>Success!</strong> An email has been sent to your email. Please check your email.</div>');
				     	$("#button-forgot-password").attr('disabled');
				     	$("#button-forgot-password").html('Confirm');
				     	setTimeout(function(){
							$("#modal-forgot-password").modal('hide');
						}, 3000);
				    }
				    else if(msg == 'false') {
				     	$("#button-forgot-password").html('Confirm');
						$("#error-forgot-password").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Failed to sending email. Please try again.</div>');
				    }
				    else if(msg == 'not-found') {
				     	$("#button-forgot-password").html('Confirm');
						$("#error-forgot-password").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Email not found. Please try again.</div>');
				    }
				    else {
						$("#button-forgot-password").html('Confirm');
						$("#error-forgot-password").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Your email doesn\'t match the email in the database.</div>');
				    }
				});
				event.preventDefault();
			}
		});
	});
</script>