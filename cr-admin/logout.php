<?php
	if(!isset($_SESSION)) {
        session_start();
    }

    require_once __DIR__.'/../cr-include/error-report.php';
	require_once __DIR__.'/include/database/connection.php';
    require_once __DIR__.'/include/autoloader.php';
	require_once __DIR__.'/include/global-function.php';

	$master_admin_url = MADMINURL;
    $master_url       = MURL;

	unset($_SESSION['cr_adminID']);
    unset($_SESSION['cr_adminPassword']); 
	header("location:$master_admin_url");
?>