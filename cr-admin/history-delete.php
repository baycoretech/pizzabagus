<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$historyID    = $_POST['historyID'];
    $adminLoginID = $_POST['adminLoginID'];
	if(isset($historyID) && isset($adminLoginID)) {
		require "include/database.php";//database
		require "include/class-data.php";//all data
		$o_getHistory = new history($pdo);
		$v_getDeleteHistory = $o_getHistory->deleteHistory($historyID, $adminLoginID);
	}
	else {
		echo "failed";
	}
?>