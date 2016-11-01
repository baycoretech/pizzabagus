<?php
	if (!isset($_SESSION)) {
	    session_start();
	}

	require __DIR__.'/../error-report.php';
    require __DIR__.'/../database/connection.php';
    require __DIR__.'/../autoloader.php'; 
    require __DIR__.'/../setup-function.php'; 
    require __DIR__.'/../global-function.php';

    $displayname = $_POST['displayname'];
    $email       = $_POST['email'];
    $username    = $_POST['username'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $hotelvilla  = $_POST['hotelvilla'];
    $title       = $_POST['title'];
    $firstname   = $_POST['firstname'];
    $middlename  = $_POST['middlename'];
    $lastname    = $_POST['lastname'];
    $address1    = $_POST['address1'];
    $address2    = $_POST['address2'];
    $city        = $_POST['city'];
    $detail      = $_POST['detail'];
    $customer_id = $_SESSION['cr_customerID'];

    if(empty($displayname) || empty($email) || empty($username) || empty($title) || empty($firstname) || empty($lastname) || empty($address1) || empty($city)) {
    	echo 'empty-field';
    }
    else {
		$class_customer = new Customer($pdo);
		if($new_password === $confirm_password) {
			$check_customer_username = $class_customer->check_update_customer_username($username, $email, $customer_id);
			if($check_customer_username == true) {
				$class_general_setting    = new General_Setting($pdo);
			    //Set timezone
			    $v_set_timezone           = $class_general_setting->set_timezone();
			    $get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
			    if(!empty($v_set_timezone->cr_settingValue)) {
			        date_default_timezone_set($get_timezone_city);
			    }
			    $date_for_now = new DateTime();
			    $date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
			    $now_date     = $date_for_now->format('Y-m-d H:i:s');
			    //Same format as NOW(), use to save datetime value to database, without timezone, that will be diffrent datetime insert in database

				$update_customer = $class_customer->update_customer($displayname, $email, $username, $new_password, $hotelvilla, $title, $firstname, $middlename, $lastname, $address1, $address2, $city, $detail, $customer_id, $now_date);
				if($update_customer == 'success') {
					echo "true";
				}
				elseif($update_customer == 'logout') {
					echo "logout";
				}
				else {
					echo 'false';
				}
			} 
			else {
				echo "same-username";
			}
		}
		else {
			echo 'not-equal-password';
		}
	}
?>