<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_customer  = new Customer($pdo);
    $username        = $_POST['username'];
    $password        = $_POST['password'];
    $email           = $_POST['email'];
    $displayname     = $_POST['displayname'];
    $hotelvilla      = $_POST['hotelvilla'];
    $title           = $_POST['title'];
    $firstname       = $_POST['firstname'];;
    $middlename      = $_POST['middlename'];
    $lastname        = $_POST['lastname'];
    $address1        = $_POST['address1'];
    $address2        = $_POST['address2'];
    $city            = $_POST['city'];
    $detail          = $_POST['detail'];
    $phone           = $_POST['phone'];
    $status          = $_POST['status'];
    $modifiedby      = 'admin,'.$_SESSION['cr_adminID'];
    $number          = $_POST['idmanual'];
    $customer_id     = $_POST['customer_id'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($username) || empty($email) || empty($displayname)) {
		echo "field-empty";
	}
	elseif(strlen($username) > 20) {
		echo 'username-long';
	}
	elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		echo 'email-invalid';
	}
	elseif(strlen($displayname) > 255) {
		echo 'displayname-long';
	}
	else {
		if(!empty($password) && strlen($password) < 6) {
			echo 'password-short';
		}
		elseif(!empty($password) && strlen($password) > 50) {
			echo 'password-long';
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

	    	$function_update_customer = $class_customer->update_customer($username, $email, $password, $displayname, $hotelvilla, $title, $firstname, $middlename, $lastname, $address1, $address2, $city, $detail, $phone, $status, $modifiedby, $number, $customer_id, $admin_login_id, $now_date);
	    	if($function_update_customer == true) {
    			echo 'true';
	    	}
	    	else 
	    		echo 'false';
	    }
    }
?>