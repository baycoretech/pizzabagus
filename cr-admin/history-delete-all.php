<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
    $adminLoginID = $_POST['adminLoginID'];
	if(isset($adminLoginID)) {
		require "include/database.php";//database
		require "include/class-data.php";//all data
		$o_getHistory = new history($pdo);
		$v_getDeleteHistory = $o_getHistory->deleteAllHistory($adminLoginID);
	}
	else {
		echo "failed";
	}
?>