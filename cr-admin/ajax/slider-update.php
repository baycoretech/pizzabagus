<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_slider  = new Slider_Image($pdo);
	$caption         = $_POST['caption'];
    $desc            = $_POST['desc'];
    $photo           = $_POST['photo'];
    $blink           = $_POST['blink'];
    $textposition    = $_POST['textposition'];
    $slider_idh      = $_POST['slider_idh'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($photo)) {
		echo "no-image";
	}
	else {
	    if(!empty($caption) && strlen($caption)>100) {
			echo "caption-long";
		}
		elseif(!empty($blink) && strlen($blink)>255) {
			echo "blink-long";
		}
		elseif(!empty($blink) && filter_var($blink, FILTER_VALIDATE_URL) === false) {
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

	    	$function_update_slider_image = $class_slider->update_slider_image($photo, $caption, $desc, $blink, $textposition, $slider_idh, $admin_login_id, $now_date);
	    	if($function_update_slider_image == true) 
		    	echo 'true';
		    else 
		    	echo 'false';
	    }
	}
?>