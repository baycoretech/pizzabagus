<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_contact   = new Contact($pdo);
	$desc            = $_POST['desc'];
	$desc_id         = $_POST['desc_id'];
    $social          = $_POST['social'];
    $customheader    = $_POST['customheader'];
    $customheader_id = $_POST['customheader_id'];
    $customdesc      = $_POST['customdesc'];
    $customdesc_id   = $_POST['customdesc_id'];
    $link            = $_POST['link'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($social)) {
    	echo 'empty-field';
    }
    else {
	    if(!empty($customheader) && strlen($customheader) > 100) {
			echo "cheader-long";
		}
		elseif(!empty($customdesc) && strlen($customdesc) > 500) {
			echo "cdesc-long";
		}
		elseif(!empty($customheader_id) && strlen($customheader_id) > 100) {
			echo "cheader-long";
		}
		elseif(!empty($customdesc_id) && strlen($customdesc_id) > 500) {
			echo "cdesc-long";
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

	    	$function_add_contact = $class_contact->add_contact($desc, $desc_id, $social, $customheader, $customheader_id, $customdesc, $customdesc_id, $link, $admin_login_id, $now_date);
	    	if($function_add_contact == true) 
		    	echo 'true';
		    else 
		    	echo 'false';
	    }
	}
?>