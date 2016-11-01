<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getFavicon = new favicon($pdo);
    $photo           = $_POST['photo'];
    $adminLoginID    = $_POST['adminLoginID'];

    if($photourl==MADMINURL."/assets/img/no-pic-items.png") {
		echo "no-image";
	}
	else {
    	$v_getAddFavicon = $o_getFavicon->updateFavicon($photo, $adminLoginID);
    	echo "success";
    	
    }
?>