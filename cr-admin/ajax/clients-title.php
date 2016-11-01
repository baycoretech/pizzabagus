<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_clients   = new Clients($pdo);
    $class_settings  = new Settings($pdo);
	$value           = $_POST['clientstitle'];
    $setting_name    = $_POST['settingname'];
    $setting_idh     = $_POST['settingIDh'];
    $psettingname    = 'Clients in Page';
    if(!empty($_POST['cppage'])) {
	    $clientsinpage   = implode(',', $_POST['cppage']);
	}
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($value) || empty($setting_name) || empty($setting_idh)) {
    	echo 'empty-field';
    }
    else {
	    if(!empty($value) && strlen($value) > 50) {
			echo "title-long";
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

			$function_update_settings = $class_settings->update_settings($value, $setting_name, $admin_login_id, $setting_idh, $now_date);
			if(!empty($_POST['cppage'])) {
    			$function_clients_pageid = $class_clients->view_clients_in_page_id();

                $set_clients_page = $class_settings->update_settings($clientsinpage, $psettingname, $admin_login_id, $function_clients_pageid, $now_date);  
            }

			if($function_update_settings == true) 
		    	echo 'true';
		    else 
		    	echo 'false';
	    }
	}
?>