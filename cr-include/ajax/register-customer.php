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
    $password    = $_POST['password'];
    $hotelvilla  = $_POST['hotelvilla'];
    $title       = $_POST['title'];
    $firstname   = $_POST['firstname'];
    $middlename  = $_POST['middlename'];
    $lastname    = $_POST['lastname'];
    $address1    = $_POST['address1'];
    $address2    = $_POST['address2'];
    $city        = $_POST['city'];
    $detail      = $_POST['detail'];
    $phone       = $_POST['phone'];

    if(empty($displayname) || empty($email) || empty($username) || empty($password) || empty($title) || empty($firstname) || empty($lastname) || empty($address1) || empty($city) || empty($phone)) {
    	echo 'empty-field';
    }
    else {
		$class_customer = new Customer($pdo);
		$check_customer_username = $class_customer->check_customer_username($username, $email);
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

			$add_customer = $class_customer->add_customer($displayname, $email, $username, $password, $hotelvilla, $title, $firstname, $middlename, $lastname, $address1, $address2, $city, $detail, $phone, $now_date);
			if($add_customer == true) {
				echo "true";
			}
			else {
				echo 'false';
			}
		} 
		else {
			echo "same-username";
		}
	}?>