<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//all data
	$o_get_banner = new Banner($pdo);
    $photo           = $_POST['photo'];
    $link            = $_POST['link'];
    $admin_login_id  = $_POST['adminLoginID'];

    if(strlen($link)>255) {
		echo "link-long";
	}
	elseif(strlen($link)<1) {
		echo "link-short";
	}
	elseif(filter_var($link, FILTER_VALIDATE_URL) === false) {
    	echo 'invalid-url';
    }
	elseif(empty($photo)) {
		echo "no-picture";
	}
	else {
		$v_get_add_banner = $o_get_banner->add_banner($photo, $link, $admin_login_id);
		echo "success";
	}   
?>