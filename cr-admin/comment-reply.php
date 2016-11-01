<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$commentID = $_POST['commentID'];
	$content   = $_POST['content'];
	$blogID    = $_POST['blogID'];
	$adminID   = $_POST['adminLoginID'];
	if(isset($commentID) && isset($adminID) && isset($blogID) && isset($content)) {
		if(empty($content)) {
			echo "false";
		}
		else {
			require_once "include/database.php";//database
			require_once "include/class-data.php";//all data
			$o_getComment       = new comment($pdo);
			$v_getUpdateComment = $o_getComment->replyComment($commentID, $content, $blogID, $adminID);
		}
	}
	else {
		echo "false";
	}

?>