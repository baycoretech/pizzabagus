<?php
	ini_set('display_errors', 1);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getMenu       = new menu($pdo);
    $title           = $_POST['title'];
    $status          = $_POST['status'];
    $submenuIDh      = $_POST['submenuIDh'];
    $adminLoginID    = $_POST['adminLoginID'];

    if($title=="tag" || $title=="Tag" || $title=="checkout" || $title=="Checkout" || $title=="Checkout Review" || $title=="checkout-review" || $title=="Payment" || $title=="payment" || $title=="Invoice" || $title=="invoice") {
		echo "reserved-text";
	}
	elseif(strlen($title)<4) {
		echo "title-short";
	}
	elseif(strlen($title)>25) {
		echo "title-long";
	}
	else {
		$v_getUpdateSubmenu = $o_getMenu->updateSubmenus($title, $status, $submenuIDh, $adminLoginID);
		if($v_getUpdateSubmenu==1) {
		    echo "same-title";
		}
		else {
			echo "success";
		}
	}
        
?>