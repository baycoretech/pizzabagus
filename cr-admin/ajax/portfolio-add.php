<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';
    $class_portfolio = new Portfolio($pdo);
    $title           = $_POST['title'];
    $desc            = $_POST['editorportfolio'];
    $slider_image    = $_POST['slider'];
    $photo           = $_POST['photo'];
    $cat             = $_POST['cat'];
    $status          = $_POST['status'];
    $metakey         = $_POST['metakey'];
    $metadesc        = $_POST['metadesc'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($title) || empty($cat) || empty($status)) {
    	echo 'empty-field';
    }
    else {
    	if($photo == MADMINURL."assets/img/no-pic-items.png") {
			echo "no-image";
		}
		else {
			if(strlen($title) > 200) {
	        	echo "title-long";
		    }
		    elseif(strlen($title) < 3) {
	        	echo "title-short";
		    }
		    elseif($title == "sort" || $title == "Sort") {
	        	echo "reserved-word";
		    }
		    elseif(strlen($metakey) > 255) {
	        	echo "metakey-long";
		    }
		    elseif(strlen($metadesc) > 155) {
	        	echo "metadesc-long";
		    }
		    elseif(strlen($slider_image) < 1) {
		    	echo "no-slider";
		    }
		    else {
		      	$function_check_name_portfolio = $class_portfolio->check_name_portfolio($title);
		        if($function_check_name_portfolio == true) {
		        	echo "same-title";
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

			        $function_add_portfolio = $class_portfolio->add_portfolio($title, $desc, $photo, $slider_image, $cat, $status, $metakey, $metadesc, $admin_login_id, $now_date);
			        if($function_add_portfolio == true) 
				    	echo 'true';
				    else 
				    	echo 'false';
			    }
			}
		}
	}
?>