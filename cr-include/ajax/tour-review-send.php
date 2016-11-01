<?php
	require __DIR__.'/../error-report.php';
    require __DIR__.'/../database/connection.php';
    require __DIR__.'/../autoloader.php';
    require __DIR__.'/../global-function.php';

    $class_tours_reviews = new Featured_Tours_Reviews($pdo);
	$tour_id      = $_POST['tour_id'];
    $reviewname   = $_POST['reviewname'];
    $reviewemail  = $_POST['reviewemail'];
    $reviewtitle  = $_POST['reviewtitle'];
    $reviewstar   = $_POST['reviewstar'];
    $reviewtext   = $_POST['reviewtext'];

	if(empty($reviewname) || empty($reviewemail) || empty($reviewtitle) || empty($reviewstar) || empty($reviewtext)) {
    	echo "empty-field";
    }
    else {
    	if(strlen($reviewname)<4) {
			echo "name-long";
		}
		elseif(strlen($reviewname)>50) {
			echo "name-long";
		}
		elseif(strlen($reviewtitle)<3) {
			echo "subject-long";
		}
		elseif(strlen($reviewtitle)>100) {
			echo "subject-long";
		}
		elseif(strlen($reviewtext)<4) {
			echo "review-long";
		}
		elseif(strlen($reviewtext)>1000) {
			echo "review-long";
		}
		elseif(filter_var($reviewemail, FILTER_VALIDATE_EMAIL) === false) {
			echo "email-invalid";
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

	    	$function_send_review = $class_tours_reviews->send_review($reviewname, $reviewtitle, $reviewemail, $reviewstar, $reviewtext, $tour_id, $now_date);
	    	if($function_send_review == true) 
		    	echo 'true';
		    else 
		    	echo 'false';
	    }
	}
?>