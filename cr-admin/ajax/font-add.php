<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_appearance = new Appearance($pdo);
	$name             = $_POST['name'];
    $link             = $_POST['link'];
    $family           = $_POST['family'];
    $applied          = $_POST['applied'];
    $admin_login_id   = $_SESSION['cr_adminID'];

    if(empty($name) || empty($link) || empty($family) || empty($applied)) {
    	echo 'empty-field';
    }
    else {
	    if(!empty($name) && strlen($name)>100) {
			echo "name-long";
		}
		elseif(!empty($link) && strlen($link)>255) {
			echo "link-long";
		}
		elseif(!empty($family) && strlen($family)>100) {
			echo "family-long";
		}
		else {
			$function_check_fonts = $class_appearance->check_fonts($applied);
			if($function_check_fonts < 1) {
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

		    	$function_add_font = $class_appearance->add_font($name, $link, $family, $applied, $admin_login_id, $now_date);
		    	if($function_add_font == true) 
			    	echo 'true';
			    else 
			    	echo 'false';
			}
			else {
				echo 'applied-exist';
			}
	    }
	}
?>