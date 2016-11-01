<?php
	ini_set('display_errors', 1);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$commentID = $_POST['commentID'];
	$adminID   = $_POST['adminLoginID'];
	if(isset($commentID) && isset($adminID)) {
		require "include/database.php";//database
		require "include/class-data.php";//all data
		$o_getComment       = new comment($pdo);
		$v_getUpdateComment = $o_getComment->deleteComment($commentID, $adminLoginID);
	}
	else {
		echo "false";
	}
?>