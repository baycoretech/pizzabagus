<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$commentID = $_POST['commentid'];
	if(isset($commentID)) {
		require_once "include/database.php";//database
		require_once "include/class-data.php";//all data
		$o_getComment       = new comment($pdo);
		$v_getUpdateComment = $o_getComment->unapproveComment($commentID);
	}
	else {
		echo "false";
	}

?>