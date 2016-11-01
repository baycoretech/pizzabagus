<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_bank      = new Bank_Account($pdo);
	$name            = $_POST['name'];
    $number          = $_POST['number'];
    $owner           = $_POST['owner'];
    $image           = $_POST['image'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($name) || empty($number) || empty($owner)) {
    	echo 'empty-field';
    }
    else {
	    if(empty($image)) {
			echo "no-image";
		}
		else {
		    if(!empty($name) && strlen($name)>100) {
				echo "name-long";
			}
			elseif(!empty($number) && strlen($number)>100) {
				echo "number-long";
			}
			elseif(!empty($owner) && strlen($owner)>255) {
				echo "owner-long";
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

		    	$function_add_bank_account = $class_bank->add_bank_account($name, $number, $owner, $image, $admin_login_id, $now_date);
		    	if($function_add_bank_account == true) 
			    	echo 'true';
			    else 
			    	echo 'false';
		    }
		}
	}
?>