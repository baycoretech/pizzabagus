<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_contact_header  = new Contact_Header($pdo);
    $email           = $_POST['email'];
    $phone           = $_POST['phone'];
    $socmed          = $_POST['socmed'];
    $setting_idh     = $_POST['setting_idh'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($email))
        $emailpost = "0";
    else
        $emailpost = $email;

    if(empty($phone))
        $phonepost = "0";
    else
        $phonepost = $phone;

    if(empty($socmed))
        $socmedpost = "0";
    else
        $socmedpost = $socmed;

    $arr   = array($emailpost,$phonepost,$socmedpost);
    $value = implode(",", $arr);

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

    $function_update_contact_header = $class_contact_header->update_contact_header($value, $admin_login_id, $setting_idh, $now_date);
    if($function_update_contact_header == true) 
    	echo 'true';
    else 
    	echo 'false';
?>