<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
  	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function 

	if (!empty($_FILES)) {
		$admin_login_id = $_SESSION['cr_adminID']; 
	    $o_get_media = new Media($pdo);
	    foreach($_FILES['file']['name'] as $index=>$name){
	    	$target_path = '../cr-editor/images/'; 
	    	$temp_file = $_FILES['file']['tmp_name']; 
	    	$extension = end(explode(".", $name));
		    $file_name = md5(uniqid(rand(), true));
		    $target_file =  $target_path.$file_name; 
	    	move_uploaded_file($temp_file[$index],$target_file.'.'.$extension);
	    	$v_get_add_media = $o_get_media->add_media($file_name.'.'.$extension, $admin_login_id);
	    	$result[] = $file_name.'.'.$extension;
	    }
	    header('Content-type: text/json');              //3
	    header('Content-type: application/json');
	    echo json_encode($result);
	}
?>