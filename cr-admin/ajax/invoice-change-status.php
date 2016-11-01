<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_invoice  = new Invoice($pdo);
    $invoice_id     = $_POST['invoice_id'];
    $status         = $_POST['status'];
    $admin_login_id = $_SESSION['cr_adminID'];

    if(empty($status)) {
		echo "empty-field";
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

	    $function_change_invoice_status = $class_invoice->change_invoice_status($invoice_id, $status, $admin_login_id, $now_date);
	    if($function_change_invoice_status == true) 
		    echo 'true';
		else 
		  	echo 'false';
	}
?>