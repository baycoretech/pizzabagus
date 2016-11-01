<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_administrator = new Administrator($pdo);
    $empty           = $_POST['empty'];
    $username        = $_POST['username'];
    $password        = $_POST['password'];
    $email           = $_POST['email'];
    $photourl        = $_POST['photo'];
    $photo           = str_replace(MADMINURL,"",$photourl);
    $displayname     = $_POST['displayname'];
    $level           = '1';
    $aboutyou        = $_POST['aboutyou'];
    $fb              = $_POST['facebook'];
    $gp              = $_POST['googleplus'];
    $tw              = $_POST['twitter'];
    $admin_login_id  = $_SESSION['cr_adminID'];
    if(empty($username) || empty($email) || empty($displayname)) {
		echo "field-empty";
	}
	elseif(strlen($username) < 4) {
		echo 'username-short';
	}
	elseif(strlen($username) > 20) {
		echo 'username-long';
	}
	elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		echo 'email-invalid';
	}
	elseif(strlen($displayname) < 4) {
		echo 'displayname-short';
	}
	elseif(strlen($displayname) > 20) {
		echo 'displayname-long';
	}
	else {
		if(!empty($password) && strlen($password) < 6) {
			echo 'password-short';
		}
		elseif(!empty($password) && strlen($password) > 20) {
			echo 'password-long';
		}
		elseif(!empty($aboutyou) && strlen($aboutyou) > 255) {
			echo 'aboutyou-long';
		}
		elseif(!empty($fb) && filter_var($fb, FILTER_VALIDATE_URL) === false) {
			echo 'fb-invalid';
		}
		elseif(!empty($gp) && filter_var($gp, FILTER_VALIDATE_URL) === false) {
			echo 'gp-invalid';
		}
		elseif(!empty($tw) && filter_var($tw, FILTER_VALIDATE_URL) === false) {
			echo 'tw-invalid';
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

	    	$function_update_profile = $class_administrator->update_profile($username, $password, $email, $photo, $displayname, $level, $aboutyou, $fb, $gp, $tw, $admin_login_id, $now_date);
	    	if($function_update_profile == true) {
	    		if(!empty($password)) 
	    			echo 'logout';
	    		else 
	    			echo 'true';
	    	}
	    	else 
	    		echo 'false';
	    }
    }
?>