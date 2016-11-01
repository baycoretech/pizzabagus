<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$media_id       = $_POST['media_id'];
	$media_name     = $_POST['media_name'];
    $admin_login_id = $_POST['admin_login_id'];
	if(isset($media_id) && isset($media_name) && isset($admin_login_id)) {
		require "include/database.php";//database
		require "include/class-data.php";//all data
		$o_get_media = new Media($pdo);
		$v_get_delete_media = $o_get_media->delete_media($media_id, $media_name, $admin_login_id);
		if($v_get_delete_media == 'success') {
			echo 'success';
		}
		else {
			echo 'failed';
		}
	}
	else {
		echo "error";
	}
?>