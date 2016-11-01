<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$media_id       = $_POST['media_id'];
	$media_title    = $_POST['media_title'];
	$media_desc     = $_POST['media_desc'];
    $admin_login_id = $_POST['admin_login_id'];
	if(isset($media_id) && isset($media_title) && isset($media_desc) && isset($admin_login_id)) {
		require "include/database.php";//database
		require "include/class-data.php";//all data
		$o_get_media = new Media($pdo);
		$v_get_update_media = $o_get_media->update_media($media_title, $media_desc, $admin_login_id, $media_id);
		if($v_get_update_media == 'success') {
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