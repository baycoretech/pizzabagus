<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    require __DIR__.'/../error-report.php';
    require __DIR__.'/../database/connection.php';
    require __DIR__.'/../autoloader.php'; 
    require __DIR__.'/../setup-function.php'; 
    require __DIR__.'/../global-function.php';

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

    $crusername   = $_POST['username'];
    $crpassword   = $_POST['password'];
    if(empty($crusername) || empty($crpassword)) {
        echo 'empty-field';
    }
    else {
        $class_customer    = new Customer($pdo);
        $login_customer    = $class_customer->login_customer($crusername);
        if($login_customer != false) {
            $customer_password = $login_customer->cr_customerPassword;

            if(verify_password($crpassword, $customer_password) == true) {
                $_SESSION['cr_customerID']       = $login_customer->cr_customerID;
                $_SESSION['cr_customerPassword'] = $login_customer->cr_customerPassword; 
                $set_last_login = $class_customer->set_last_login($_SESSION['cr_customerID'], $now_date);
                echo "true";
            }
            else {
                echo "false";
            }
        }
        else {
           echo 'invalid'; 
        }
    }
?>