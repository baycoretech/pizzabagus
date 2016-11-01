<?php
    if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../../cr-include/altorouter.php';
    require __DIR__.'/../include/global-function.php';

    $username   = $_POST['username'];
    $password   = $_POST['password'];

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

    $class_administrator = new Administrator($pdo);
    $function_login_administrator = $class_administrator->login_administrator($username);
    $password_administrator = $function_login_administrator->cr_adminPassword;

    $check_password = crypt($password, $password_administrator) == $password_administrator;
    if($check_password == true && $function_login_administrator == true) {
		$_SESSION['cr_adminID']       = $function_login_administrator->cr_adminID;
		$_SESSION['cr_adminPassword'] = $function_login_administrator->cr_adminPassword; 
        $function_set_last_login      = $class_administrator->set_last_login($_SESSION['cr_adminID'], $now_date);
        /*if(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/setup-page.php')) {  
            unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/setup-page.php');
        }*/
		echo "true";
	}
	else {
		echo "false";
	}
    
?>