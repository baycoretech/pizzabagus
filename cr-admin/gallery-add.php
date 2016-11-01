<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//all data
	$o_getGallery = new gallery($pdo);
    $title           = $_POST['title'];
    $desc            = $_POST['desc'];
    //$photourl        = $_POST['photo'];
    //$photo           = str_replace(MADMINURL."/..","",$photourl);
    $photo           = $_POST['photo'];
    $link            = $_POST['link'];
    $adminLoginID    = $_POST['adminLoginID'];

    if(strlen($title)>200) {
		echo "title-long";
	}
	elseif(strlen($title)<3) {
		echo "title-short";
	}
	elseif(empty($photo)) {
		echo "no-picture";
	}
	else {
		$v_getAddGallery = $o_getGallery->addGallery($title, $desc, $photo, $link, $adminLoginID);
		echo "success";
	}   
?>