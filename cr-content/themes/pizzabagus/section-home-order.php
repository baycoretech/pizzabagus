<div class="home-order">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1 class="welcome-greeting animate-plus" data-animations="fadeInDown" data-animation-duration="1s" data-animation-delay="1s">
				<?php
					if(!isset($lang)) {
                    	$welcome_text = 'WELCOME TO PIZZA BAGUS ONLINE ORDERING';
                    	$order_text   = 'To place an order please SIGN IN or REGISTER to create your account.';
                    	$ph_home_username = 'USERNAME';
                    	$ph_home_password = 'PASSWORD';
                    	$signin_btn       = 'SIGN IN';
                    	$signin_question  = 'Don\'t have an account?';
                    	$forgot_password  = 'Forgot Password';
                    }
                    else {
                        if($lang == $default_language->cr_languageCode) {
                    		$welcome_text = 'WELCOME TO PIZZA BAGUS ONLINE ORDERING';
                    		$order_text   = 'To place an order please SIGN IN or REGISTER to create your account.';
                    		$ph_home_username = 'USERNAME';
                    		$ph_home_password = 'PASSWORD';
                    		$signin_btn       = 'SIGN IN';
                    		$signin_question  = 'Don\'t have an account?';
                    		$forgot_password  = 'Forgot Password';
                        }
                        else {
                    		$welcome_text = 'SELAMAT DATANG DI PEMESANAN ONLINE PIZZA BAGUS';
                    		$order_text   = 'Silahkan MASUK atau DAFTAR untuk memesan.';
                    		$ph_home_username = 'NAMA PENGGUNA';
                    		$ph_home_password = 'SANDI';
                    		$signin_btn       = 'MASUK';
                    		$signin_question  = 'Belum punya akun?';
                    		$forgot_password  = 'Lupa Sandi';
                        }
                    }
                    echo $welcome_text;
				?>
				</h1>
			</div>

			<div class="col-md-<?php if(empty($_SESSION['cr_customerID']) && empty($_SESSION['cr_customerPassword'])) echo '10'; else echo '4' ?> col-md-offset-<?php if(empty($_SESSION['cr_customerID']) && empty($_SESSION['cr_customerPassword'])) echo '1'; else echo '4' ?>">
				<div class="home-login-box animate-plus" data-animations="fadeIn" data-animation-duration="1s" data-animation-delay="2s">
				<?php 
    				if(empty($_SESSION['cr_customerID']) && empty($_SESSION['cr_customerPassword'])) {
				?>
					<p class="text-center"><?php echo $order_text ?></p>
					<div id="error-home-signin"></div>
					<form id="form-home-signin" class="form-inline home-login-form" data-parsley-validate action="" method="POST">
						<div class="form-group">
						    <input type="text" class="form-control" id="home_login_username" name="username" placeholder="<?php echo $ph_home_username ?>">
						</div>
					    <div class="form-group">
					    	<input type="password" class="form-control" id="home_login_password" name="password" placeholder="<?php echo $ph_home_password ?>">
					    </div>
					    <div class="form-group">
					  		<button id="button-home-signin" type="submit" class="btn btn-default animate-plus" data-animations="pulse,pulse" data-animation-duration="500ms" data-animation-delay="3s"><?php echo $signin_btn ?></button>
				  		</div>
					</form>
					<ul class="home-account">
						<li><a href="#" data-target="#modal-register-customer" data-toggle="modal"><?php echo $signin_question ?></a></li>
						<li><a href=""><?php echo $forgot_password ?></a></li>
					</ul>
				<?php } else { ?>
					<img class="initial-photo img-circle" src="" width="120" height="120" data-width="120" data-height="120" data-font-size="80" data-name="<?php echo $customer_displayname ?>">
					<h3 class="customer-name"><?php echo $customer_displayname ?><br><small><?php echo $customer_email ?></small></h3>
					<p class="home-customer-action"><a href="<?php echo $router->generate('specific-page-lang', array('lang' => $lang, 'page' => 'profile')) ?>"><i class="fa fa-user"></i></a> <a href="<?php echo MURL.'logout.php' ?>"><i class="fa fa-power-off"></i></a></p>
				<?php } ?>
				</div>
			</div>	
		</div>
	</div>
</div>