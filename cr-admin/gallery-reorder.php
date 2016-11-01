<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_get_gallery         = new gallery($pdo);
	$id_array	           = explode(",",$_POST['ids']);
	$v_get_reorder_gallery = $o_get_gallery->reorderGallery($id_array);
?>