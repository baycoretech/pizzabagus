<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getMenu       = new menu($pdo);
    $title           = $_POST['title'];
    $link            = $_POST['link'];
    $status          = $_POST['status'];
    $submenuIDh      = $_POST['submenuIDh'];
    $option          = "customlink";
    $adminLoginID    = $_POST['adminLoginID'];

    if($title=="tag" || $title=="Tag" || $title=="cr-admin" || $title=="cr-content" || $title=="cr-include") {
		echo "reserved-text";
	}
	elseif(strlen($title)<4) {
		echo "title-short";
	}
	elseif(strlen($title)>25) {
		echo "title-long";
	}
	elseif(strlen($link)<3) {
		echo "link-short";
	}
	elseif(strlen($link)>500) {
		echo "link-long";
	}
	elseif(empty($status)) {
		echo "status-empty";
	}
	elseif(filter_var($link, FILTER_VALIDATE_URL) === false) {
		echo "invalid-url";
	}
	else {
		$v_getUpdateSubCustomlink = $o_getMenu->updateSubCustomlink($title, $link, $status, $option, $submenuIDh, $adminLoginID);
		if($v_getUpdateSubCustomlink==1) {
		    echo "same-title";
		}
		else {
			echo "success";
		}
	}
        
?>