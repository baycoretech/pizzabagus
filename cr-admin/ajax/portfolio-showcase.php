<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';
    $class_menu      = new Menu($pdo);
    $action          = $_POST['action'];
    $page_link       = $_POST['pageshowcase'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($page_link)) {
		if($action == 'set') {
    		echo 'set,empty-page';
    	}
    	elseif($action == 'remove') {
    		echo 'remove,empty-page';
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

		if($action == 'set') {
	        $function_set_showcase_portfolio = $class_menu->set_showcase_portfolio($admin_login_id, $page_link, $now_date);
	        if($function_set_showcase_portfolio == true) 
		    	echo 'set,true';
		    else 
		    	echo 'set,false';
		}
		elseif($action == 'remove') {
	        $function_unshowcase_portfolio = $class_menu->unshowcase_portfolio($admin_login_id, $page_link, $now_date);
	        if($function_unshowcase_portfolio == true) 
		    	echo 'remove,true';
		    else 
		    	echo 'remove,false';
		}
	}
?>