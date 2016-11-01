<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	
    $status        = $_POST['status'];
    $invoice_idh   = $_POST['invoice_idh'];
    $adminLoginID  = $_POST['adminLoginID'];

    if(empty($status) || empty($invoice_idh) || empty($adminLoginID)){
        echo "field-empty";           
    }
    else {
    	$o_get_invoice = new Invoice($pdo);
	    $v_get_change_status = $o_get_invoice->change_invoice_status($invoice_idh, $status, $adminLoginID);
	    if($v_get_change_status == 'success')
	    	echo 'success';
	    else 
	    	echo 'failed';
    }
?>