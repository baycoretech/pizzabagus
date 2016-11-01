<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';
    $class_portfolio = new Portfolio($pdo);
    $action          = $_POST['action'];
    $portfolio_idh   = $_POST['selected_portfolio_id'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($portfolio_idh)) {
		if($action == 'select') {
    		echo 'select,empty-portfolio';
    	}
    	elseif($action == 'unselect') {
    		echo 'unselect,empty-portfolio';
    	}
    }
    else {
    	//Set timezone
		$class_general_setting    = new General_Setting($pdo);
		$v_set_timezone           = $class_general_setting->set_timezone();
	 	$get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
		if(!empty($v_set_timezone->cr_settingValue)) {
		    date_default_timezone_set($get_timezone_city);
		}
		$date_for_now = new DateTime();
		$date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
		$now_date     = $date_for_now->format('Y-m-d H:i:s');
		//Same format as NOW(), use to save datetime value to database

		if($action == 'select') {
	        $function_set_selected_portfolio = $class_portfolio->set_selected_portfolio($admin_login_id, $portfolio_idh, $now_date);
	        if($function_set_selected_portfolio == true) 
		    	echo 'select,true';
		    else 
		    	echo 'select,false';
		}
		elseif($action == 'unselect') {
	        $function_unset_selected_portfolio = $class_portfolio->unset_selected_portfolio($admin_login_id, $portfolio_idh, $now_date);
	        if($function_unset_selected_portfolio == true) 
		    	echo 'unselect,true';
		    else 
		    	echo 'unselect,false';
		}
	}
?>