<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require "include/database.php";//database
	require "include/class-data.php";//all data

    $payment_id  = $_POST['payment_id'];
	$status  = $_POST['status'];
	$admin_id = $_POST['admin_id'];
    $o_get_payment_method  = new Payment_Method($pdo);
    $v_get_change_payment_status = $o_get_payment_method->change_payment_status($payment_id, $status, $admin_id);
    if($v_get_change_payment_status == 'success') {
    	echo 'success';
    }
    else {
    	echo 'failed';
    }
?>