<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_clients  = new Clients($pdo);
	$name            = $_POST['name'];
	if(empty($_POST['link']))
    	$link = NULL;
    else {
    	$link = $_POST['link'];
    }
    $photo           = $_POST['photo'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($name)) {
    	echo 'empty-field';
    }
    else {
    	if(empty($photo)) {
			echo "no-image";
		}
	    elseif(!empty($name) && strlen($name) > 50) {
			echo "name-long";
		}
		elseif(!empty($link) && filter_var($link, FILTER_VALIDATE_URL) === false) {
			echo "invalid-url";
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

	    	$function_add_clients = $class_clients->add_clients($name, $link, $photo, $admin_login_id, $now_date);
	    	if($function_add_clients == true) 
		    	echo 'true';
		    else 
		    	echo 'false';
	    }
	}
?>