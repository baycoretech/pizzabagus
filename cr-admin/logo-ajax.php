<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getLogo = new logo($pdo);
    $photo           = $_POST['photo'];
    $adminLoginID    = $_POST['adminLoginID'];

    if($photo==MADMINURL."/assets/img/no-pic-items.png") {
		echo "no-image";
	}
	else {
    	$v_getAddLogo = $o_getLogo->updateLogo($photo, $adminLoginID);
    	echo "success";
    	
    }
?>