<?php
	if(!isset($_SESSION)) {
        session_start();
    }

    require __DIR__.'/cr-include/error-report.php';
    require __DIR__.'/cr-include/database/connection.php';
    require __DIR__.'/cr-include/autoloader.php'; 
    require __DIR__.'/cr-include/global-function.php';

	unset($_SESSION['cr_customerID']);
    unset($_SESSION['cr_customerPassword']); 
    unset($_SESSION['order']); 
	header("location:$master_url");
?>