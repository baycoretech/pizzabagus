<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';
    $class_ourmenu   = new Our_Menu($pdo);
    $action          = $_POST['action'];
    $ourmenu_idh     = $_POST['selected_ourmenu_id'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($ourmenu_idh)) {
		if($action == 'select') {
    		echo 'select,empty-ourmenu';
    	}
    	elseif($action == 'unselect') {
    		echo 'unselect,empty-ourmenu';
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
	        $function_set_selected_ourmenu = $class_ourmenu->set_selected_ourmenu($admin_login_id, $ourmenu_idh, $now_date);
	        if($function_set_selected_ourmenu == true) 
		    	echo 'select,true';
		    else 
		    	echo 'select,false';
		}
		elseif($action == 'unselect') {
	        $function_unset_selected_ourmenu = $class_ourmenu->unset_selected_ourmenu($admin_login_id, $ourmenu_idh, $now_date);
	        if($function_unset_selected_ourmenu == true) 
		    	echo 'unselect,true';
		    else 
		    	echo 'unselect,false';
		}
	}
?>