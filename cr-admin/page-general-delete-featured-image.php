<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$page_id    = $_POST['pageid'];
	if(isset($page_id)) {
		require "include/database.php";//database
		require "include/class-data.php";//all data
		$o_get_page = new page($pdo);
		$v_get_delete_featured_image = $o_get_page->deleteFeaturedImage($page_id);
	}
	else {
		echo "failed";
	}
?>