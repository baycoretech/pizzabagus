<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$class_menu      = new Menu($pdo);
    $title           = $_POST['title'];
    $title_id        = $_POST['title_id'];
    $parent          = $_POST['parent'];
    $status          = $_POST['status'];
    $page_template   = $_POST['pagetemplate'];
    $option          = $_POST['option'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($title) || empty($title_id) || empty($status) || empty($page_template)) {
    	echo 'empty-field';
    }
    else {
	    if($title == "cr-admin" || $title == "cr-content" || $title == "cr-include") {
			echo "reserved-text";
		}
		elseif(strlen($title)<4) {
			echo "title-short";
		}
		elseif(strlen($title)>25) {
			echo "title-long";
		}
		elseif(strlen($title_id)<4) {
			echo "title-short";
		}
		elseif(strlen($title_id)>25) {
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

			$function_check_menu_title = $class_menu->check_menu_title($title);
			if($function_check_menu_title == true) {
				$function_add_menu = $class_menu->add_menu($title, $title_id, $parent, $status, $page_template, $option, $admin_login_id, $now_date);
				if($function_add_menu == true) {
				    echo "true";
				}
				else {
					echo "false";
				}
			}
			else 
				echo 'same-title';
		}
    }
?>